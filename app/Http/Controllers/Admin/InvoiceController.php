<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Client;
use App\Models\Payment;
use App\Models\Notification;

class InvoiceController extends Controller
{
    private function _invoiceNumber()
    {
        $invoiceNumber  = "INV-".rand(1000,9999);
        return $invoiceNumber; 
    }

    public function index()
    {
        $invoices = Invoice::all();
        return view('admin.invoices', compact('invoices'));
    }

    public function selectClient()
    {
        $clients = Client::where('status', 'Active')->get();
        return view('admin.invoices_client', compact('clients'));
    }

    public function getByClientId(Request $request)
    {
        $id         = $request->client_id;
        $client    = Client::find($id);
        return view('admin.invoices_create', compact('client'));
    }

    public function create()
    {
        $clients = Client::all();
        return view('admin.invoices_create', compact('clients'));
    }

    public function store(Request $request)
    {
        $invoice                = new Invoice();
        $user_id                = Client::find($request->client_id)->user_id;
        $invoice->client_id     = $request->client_id;
        $invoice->user_id       = $user_id;
        $invoice->number        = "INV-" . rand(1000, 9999);
        $invoice->date          = $request->date;
        $invoice->due_date      = $request->due_date;
        $invoice->total         = $request->total;
        $invoice->total_tax     = $request->total_tax;
        $invoice->note          = $request->note;
        $invoice->status        = 'Unpaid';
        $success = $invoice->save();
        if($success)
        {
            //  Kirim email ke email pelanggan
            $tujuan = Client::find($request->client_id)->email;
            $namaPelanggan = Client::find($request->client_id)->fullname;
            $invoiceTotal = $request->total + $request->total_tax;
            $data = [
                'name'              => $namaPelanggan,
                'number'            => $invoice->number,
                'amount'            => $invoiceTotal,
                'due_date'          => $request->due_date,
            ];
    
                Mail::to($tujuan)->send(new SendMail($data));

                $notif                  = new Notification();
                $user_id                = Client::find($request->client_id)->user_id;

                $notif->user_id         = $user_id;
                $notif->title           = 'Invoice baru' . " " . $invoice->number;
                $notif->message         = 'Invoice baru dengan nomor ' . $invoice->number . ' telah terkirim ke email anda. Silahkan cek email anda untuk melihat detail invoice pada menu Invoice. Silahkan melakukan pembayaran sebelum tanggal jatuh tempo. Terima kasih.';
                $notif->status          = 'Unread';
                $notif->type            = 'Info';
                if($notif->save()){
                    return redirect()->route('admin.invoices.index')->with('success', 'Invoice berhasil dikirim!');
                }else{
                    die('gagal');   
                    return redirect()->route('admin.invoices.index')->with('error', 'Invoice gagal dikirim!');
                }
            
        }
    }

    public function get_my_invoices($user_id)
    {
        $invoices = Invoice::where('user_id', $user_id)->get();
        $notifications = Notification::where('user_id', auth()->user()->id)->where('status', 'Unread')->get();
        return view('client.invoices', compact('invoices', 'notifications'));
    }

    public function my_invoice($id)
    {
        $invoice = Invoice::find($id);
        $notifications = Notification::where('user_id', auth()->user()->id)->where('status', 'Unread')->get();
        return view('client.invoice', compact('invoice', 'notifications'));
    }

    public function payment_link()
    {
        $notifications = Notification::where('user_id', auth()->user()->id)->where('status', 'Unread')->get();
        return view('client.payment_link', compact('notifications'));
    }

    public function update($id)
    {
        $invoice = Invoice::find($id);
        if($invoice->due_date < date('Y-m-d')){
            $invoice->status        = 'Overdue';
        }else{
            $invoice->status        = 'Paid';
        }
        $success = $invoice->update();
        if($success)
        {
            $payment                    = new Payment();
            $payment->number            = "HHN-" . rand(1000, 9999);
            $payment->invoice_id        = $invoice->id;
            $payment->invoice_number    = $invoice->number;
            $payment->date              = date('Y-m-d');
            $payment->method            = 'Bank Transfer';
            $payment->total             = $invoice->total + $invoice->total_tax;
            //Jika tanggal bayar lebih dari tanggal jatuh tempo maka status = Overdue
            if($invoice->due_date < date('Y-m-d')){
                $payment->status        = 'Overdue';
            }else{
                $payment->status        = 'Paid';
            }
            // $payment->status            = $invoice->status;
            $payment->save();

            return redirect()->back()->with('success', 'Faktur berhasil diupdate!');
        }
    }

   public function delete($id)
   {
         $invoice = Invoice::find($id);
         $success = $invoice->delete();
         if($success)
         {
              return redirect()->back()->with('success', 'Faktur berhasil dihapus!');
         }
   }

   //fungsi untuk menampilkan invoice yang sudah dibayar
   public function invoicesPaid()
   {
        $invoices   = Invoice::where('status', 'Paid')
        ->where('user_id', auth()->user()->id)
        ->get();
        $notifications = Notification::where('user_id', auth()->user()->id)
        ->where('status', 'Unread')
        ->get();
        return view('client.invoices_paid', compact('invoices', 'notifications'));
   }

    //fungsi untuk menampilkan invoice yang belum dibayar
    public function invoicesUnpaid()
    {
         $invoices   = Invoice::where('status', 'Unpaid')
         ->where('user_id', auth()->user()->id)
         ->get();
         $notifications = Notification::where('user_id', auth()->user()->id)
         ->where('status', 'Unread')
         ->get();
         return view('client.invoices_unpaid', compact('invoices', 'notifications'));
    }
}
