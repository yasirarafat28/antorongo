
    <div class="modal fade" id="LoanInterestCollectModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2><strong>লাভ আদায় </strong>  করুন</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="{{route('loan.collect_interest')}}" accept-charset="UTF-8" enctype="multipart/form-data" method="POST">
                        {{csrf_field()}}
                        <input type="hidden" name="loan_id" value="{{$loan->id}}">
                        <input type="hidden" name="user_id" value="{{$loan->user_id}}">

                        <div class="form-group">

                            <label for=""><small> লাভের পরিমান</small></label>

                            <input type="number" step="any" class="form-control" name="amount" placeholder="লাভের পরিমান" id="amount">

                        </div>

                        <div class="form-group">

                            <label for=""><small> তারিখ </small></label>

                            <input type="date" class="form-control" name="date" placeholder=" তারিখ">

                        </div>

                        <div class="form-group">

                            <label for=""><small> মতামত </small></label>

                            <textarea name="note" class="form-control" placeholder="মতামত"></textarea>

                        </div>
                        <div class="col-md-12 text-center">

                            <button class="btn btn-primary btn-round"> জমা করুন</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="LoanInterestAddModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2><strong>লাভ বকেয়া যোগ </strong>  করুন</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="{{route('loan.add_interest')}}" accept-charset="UTF-8" enctype="multipart/form-data" method="POST">
                        {{csrf_field()}}
                        <input type="hidden" name="loan_id" value="{{$loan->id}}">
                        <input type="hidden" name="user_id" value="{{$loan->user_id}}">

                        <div class="form-group">

                            <label for=""><small> লাভের পরিমান</small></label>

                            <input type="number" step="any" class="form-control" name="amount" placeholder="লাভের পরিমান" id="amount">

                        </div>

                        <div class="form-group">

                            <label for=""><small> তারিখ </small></label>

                            <input type="date" class="form-control" name="date" placeholder=" তারিখ">

                        </div>

                        <div class="form-group">

                            <label for=""><small> মতামত </small></label>

                            <textarea name="note" class="form-control" placeholder="মতামত"></textarea>

                        </div>
                        <div class="col-md-12 text-center">

                            <button class="btn btn-primary btn-round"> জমা করুন</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="LoanDeductRevenueModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2><strong>আসল আদায় </strong>  করুন</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="{{route('loan.collect_reveanue')}}" accept-charset="UTF-8" enctype="multipart/form-data" method="POST">
                        {{csrf_field()}}
                        <input type="hidden" name="loan_id" value="{{$loan->id}}">
                        <input type="hidden" name="user_id" value="{{$loan->user_id}}">

                        <div class="form-group">

                            <label for=""><small> আসলের পরিমান</small></label>

                            <input type="number" step="any" class="form-control" name="amount" placeholder="আসলের পরিমান" id="amount">

                        </div>

                        <div class="form-group">

                            <label for=""><small> তারিখ </small></label>

                            <input type="date" class="form-control" name="date" placeholder=" তারিখ">

                        </div>

                        <div class="form-group">

                            <label for=""><small> মতামত </small></label>

                            <textarea name="note" class="form-control" placeholder="মতামত"></textarea>

                        </div>
                        <div class="col-md-12 text-center">

                            <button class="btn btn-primary btn-round"> জমা করুন</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="LoanAddRevenueModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2><strong>আসল বকেয়া যোগ </strong>  করুন</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="{{route('loan.add_reveanue')}}" accept-charset="UTF-8" enctype="multipart/form-data" method="POST">
                        {{csrf_field()}}
                        <input type="hidden" name="loan_id" value="{{$loan->id}}">
                        <input type="hidden" name="user_id" value="{{$loan->user_id}}">

                        <div class="form-group">

                            <label for=""><small> আসলের পরিমান</small></label>

                            <input type="number" step="any" class="form-control" name="amount" placeholder="আসলের পরিমান" id="amount">

                        </div>

                        <div class="form-group">

                            <label for=""><small> তারিখ </small></label>

                            <input type="date" class="form-control" name="date" placeholder=" তারিখ">

                        </div>

                        <div class="form-group">

                            <label for=""><small> মতামত </small></label>

                            <textarea name="note" class="form-control" placeholder="মতামত"></textarea>

                        </div>
                        <div class="col-md-12 text-center">

                            <button class="btn btn-primary btn-round"> জমা করুন</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="ActiveModal{{$loan->id}}" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                        <div class="modal-header">
                            <h2><strong>ঋণ অনুমোদন করুন </strong></h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{url('admin/loan/active/'.$loan->id)}}" method="POST">
                                {{csrf_field()}}
                                <div class="row clearfix">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for=""><small>ঋণের পরিমান </small></label>
                                            <input type="text" class="form-control" placeholder="ঋণের পরিমান" name="approved_amount" value="{{$loan->request_amount}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for=""><small>মেয়াদ(মাস) </small></label>
                                            <input type="text" class="form-control" placeholder="মেয়াদ" name="duration" value="{{$loan->duration}}" >
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for=""><small>লাভের হার  </small></label>
                                            <input type="text" class="form-control" placeholder="লাভের হার" name="interest_rate" value="{{$loan->interest_rate}}">
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-info btn-round">সেভ করুন</button>
                                        </div>
                                </div>
                            </form>
                        </div>

            </div>
        </div>
    </div>
