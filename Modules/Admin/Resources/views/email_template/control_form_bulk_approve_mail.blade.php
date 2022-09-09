<!DOCTYPE html>
<html>
<head>
    <title>Pending Approvals</title>
</head>
<body>
<h2>Please view uploaded control form and Approve</h2>
@foreach($details as $detail)
<h4>Customer Name : {{ $detail['customer_name'] }}</h4>
<p>Link {{ $detail['link'] }}</p>
<h4>Stage : {{ $detail['approval_stage'] }}</h4>
@endforeach

<p>Thank you</p>
</body>
</html>
