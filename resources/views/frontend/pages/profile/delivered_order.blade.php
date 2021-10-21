@extends('frontend.pages.profile.master')
@section('profile_content')
    <div class="profile-content">
        <div class="table_page table-responsive">
            <table style="width: 99% !important">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Invoice</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>invoice</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($billings as $billing)
                        @if ($billing->order_summary->first()->current_status == 4 )
                            <tr>
                                <td>{{ $billings->firstItem() +$loop->index }}</td>
                                <td>{{ $billing->order_summary->first()->invoice_no }}</td>
                                <td>{{ $billing->created_at->format('D-M-y') }}</td>
                                <td>
                                    @foreach ($billing->order_summary as $order_summary)
                                    {{ '৳'.$order_summary->total_price }}
                                    @endforeach
                                </td>
                                <td><a href="{{ route('my-account.invoice.download',$billing->id) }}" class="view"><i class="fa fa-download"></i> Download Invoice</a></td>
                            </tr>
                        @endif
                    @empty
                    <tr>
                        <td colspan="4"> <i class="fa fa-exclamation-circle"></i> Empty</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="p-3">
                {{ $billings->links() }}
            </div>
        </div>
    </div>
@endsection
