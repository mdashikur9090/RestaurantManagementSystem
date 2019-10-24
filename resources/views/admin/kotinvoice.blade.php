<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="row p-5">
                        <div class="col-md-6">
                            <img src="http://via.placeholder.com/400x90?text=logo">
                        </div>

                        

                        <div class="col-md-6 text-right">
                            <p class="font-weight-bold mb-1">Invoice #{{$order_items[0]['order_id']}}</p>
                            <p class="font-weight-bold mb-1">Phone: {{$order_items[0]['phone']}}</p>
                            <p class="text-muted">Date: {{$order_items[0]['c_date']}}</p>
                        </div>
                    </div>

                    <hr class="my-5">

                    {{-- <div class="row pb-5 p-5">
                        <div class="col-md-6">
                            <p class="font-weight-bold mb-4">Client Information</p>
                            <p class="mb-1">John Doe, Mrs Emma Downson</p>
                            <p>Acme Inc</p>
                            <p class="mb-1">Berlin, Germany</p>
                            <p class="mb-1">6781 45P</p>
                        </div>
                    </div> --}}

                    <div class="row p-5">
                        <div class="col-md-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="border-0 text-uppercase small font-weight-bold">ID</th>
                                        <th></th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Item</th>
                                        <th></th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Quantity</th>
                                        <th></th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Unit Cost</th>
                                        <th></th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Total</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @php($no=0)
                                    @php($total = 0)
                                    @foreach($order_items as $item)
                                        @php($no+=1)
                                        @php($total += $item['price']*$item['qty'] )
                                        <tr>
                                            <td>{{ $no }}</td>
                                            <td>   </td>
                                            <td>{{ $item['food_name'] }}</td>
                                            <td>   </td>
                                            <td>{{ $item['price'] }}</td>
                                            <td>   </td>
                                            <td>{{ $item['qty'] }}</td>
                                            <td>   </td>
                                            <td>{{ $item['price']*$item['qty'] }}</td>
                                        </tr>
                                    @endforeach
                                    
                                    <tr>
                                        <th class="text-right" colspan="7">Total</th>
                                        <td>   </td>
                                        <th>{{$total}}</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- <div class="d-flex flex-row-reverse bg-dark text-white p-4">
                        <div class="py-3 px-5 text-right">
                            <div class="mb-2">Grand Total</div>
                            <div class="h2 font-weight-light">$234,234</div>
                        </div>

                        <div class="py-3 px-5 text-right">
                            <div class="mb-2">Discount</div>
                            <div class="h2 font-weight-light">10%</div>
                        </div>

                        <div class="py-3 px-5 text-right">
                            <div class="mb-2">Sub - Total amount</div>
                            <div class="h2 font-weight-light">$32,432</div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
    
    {{-- <div class="text-light mt-5 mb-5 text-center small">by : <a class="text-light" target="_blank" href="http://totoprayogo.com">totoprayogo.com</a></div> --}}

</div>


 