<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Coding Challenge</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css"/>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
    <style>
        .error {
            color: red;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6 mt-3 offset-md-3">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h6>Charging Process</h6>
                </div>
                <div class="card-body">
                    <form id="post-form" method="post" action="javascript:void(0)">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-success d-none" id="msg_div">
                                    <span id="res_message"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Enter Energy<span class="text-danger">*</span></label>
                                    <input type="text" name="energy" placeholder="Enter Energy" class="form-control">
                                    <span class="text-danger p-1">{{ $errors->first('energy') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Enter Time Rate<span class="text-danger">*</span></label>
                                    <input type="text" name="time" placeholder="Enter Time Rate" class="form-control">
                                    <span class="text-danger p-1">{{ $errors->first('time') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Enter Transaction<span class="text-danger">*</span></label>
                                    <input type="text" name="transaction" placeholder="Enter Transaction"
                                           class="form-control">
                                    <span class="text-danger p-1">{{ $errors->first('transaction') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Enter Time Start<span class="text-danger">*</span></label>
                                    <input type="text" name="timestampStart" placeholder="Enter Time Start"
                                           class="form-control">
                                    <span class="text-danger p-1">{{ $errors->first('timestampStart') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Enter Time End<span class="text-danger">*</span></label>
                                    <input type="text" name="timestampStop" placeholder="Enter Time End"
                                           class="form-control">
                                    <span class="text-danger p-1">{{ $errors->first('timestampStop') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Enter Meter Start<span class="text-danger">*</span></label>
                                    <input type="text" name="meterStart" placeholder="Enter Meter Start"
                                           class="form-control">
                                    <span class="text-danger p-1">{{ $errors->first('meterStart') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Enter Meter End<span class="text-danger">*</span></label>
                                    <input type="text" name="meterStop" placeholder="Enter Meter End"
                                           class="form-control">
                                    <span class="text-danger p-1">{{ $errors->first('meterStop') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" id="send_form" class="btn btn-block btn-success">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script>
    if ($("#post-form").length > 0) {
        $("#post-form").validate({

            rules: {
                energy: {
                    required: true,
                },
                time: {
                    required: true,
                },
                transaction: {
                    required: true,
                },
                timestampStart: {
                    required: true,
                },
                timestampStop: {
                    required: true,
                },
                meterStart: {
                    required: true,
                },
                meterStop: {
                    required: true,
                },
            },
            messages: {
                energy: {
                    required: "Please Enter Energy",
                },
                time: {
                    required: "Please Enter Time",
                },
                transaction: {
                    required: "Please Enter Transaction",
                },
                timestampStart: {
                    required: "Please Enter Time Start",
                },
                timestampStop: {
                    required: "Please Enter Time Stop",
                },
                meterStart: {
                    required: "Please Enter Meter Start",
                },
                meterStop: {
                    required: "Please Enter Meter Stop",
                },
            },
            submitHandler: function (form) {
                $('#send_form').html('Sending..');
                $.ajax({
                    url: '/rate',
                    type: "POST",
                    data: $('#post-form').serialize(),
                    success: function (response) {
                        console.log(response);
                        $('#send_form').html('Submit');
                        $('#res_message').show();
                        $('#res_message').html(response);
                        $('#msg_div').removeClass('d-none');
                        $(document).ready(function () {
                            $(this).scrollTop(0);
                        });

                        document.getElementById("post-form").reset();
                        setTimeout(function () {
                            $('#res_message').hide();
                            $('#msg_div').hide();
                        }, 10000);
                    }
                });
            }
        })
    }
</script>
</html>
