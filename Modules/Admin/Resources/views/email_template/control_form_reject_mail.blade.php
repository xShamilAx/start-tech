<!DOCTYPE html>
<html>
<head>
    <title>{{$details['customer_name']}}</title>
</head>
<body>

<h2>Please view uploaded control form and It has been rejected</h2>
<h4>Customer Name : {{ $details['customer_name'] }}</h4>
<h1>Reason{{ $details['reject_reason'] }}</h1>
<p>Link {{ $details['link'] }}</p>
<h4>Stage : {{ $details['approval_stage'] }}</h4>

<p>Thank you</p>
</body>
</html>
