<table style="font-family: Calibri; border: 1px solid black; border-collapse: collapse;">
    <tr>
        <td style="background-color: #EC9328;" ></td>
        <td style="background-color: #EC9328;  text-align: left" colspan="10">
            <b>POTENTIAL REVENUE REPORT</b></td>
        <td style="background-color: #EC9328;"></td>
    </tr>

    {{--    <tr style="background-color: #fffacd;">--}}
    {{--        <td>KPI</td>--}}
    {{--        <td>Definition</td>--}}
    {{--        <td>Weight</td>--}}
    {{--        <td>Target/Annum</td>--}}
    {{--        <td>Cumm. Target</td>--}}
    {{--        <td>Cumm. Achievement</td>--}}
    {{--    </tr>--}}

    <tr>
        <td>{{$report_month}}</td>
        <td colspan="5"><b>Mountain hawk express</b></td>
        <td colspan="2"
            style="border-right: 1px solid white; background-color: #798b00; font-weight: bold; border-bottom: 1px solid black; color:white;">
            Target
        </td>
        <td colspan="2"
            style="border-right: 1px solid white; background-color: #798b00; font-weight: bold; border-bottom: 1px solid black; color:white;">
            Achieved
        </td>
        <td colspan="2"
            style="border-right: 1px solid white; background-color: #798b00; font-weight: bold; border-bottom: 1px solid black; color:white;">
            Percentage
        </td>
    </tr>
    <tr>
        <td style="border-right: 1px solid white; background-color: #1F618D; font-weight: bold; border-bottom: 1px solid black; color:white;">
            Assigned user
        </td>
        <td style="border-right: 1px solid white; background-color: #1F618D; font-weight: bold; border-bottom: 1px solid black; color:white;">
            Opportunity name
        </td>
        <td style="border-right: 1px solid white; background-color: #1F618D; font-weight: bold; border-bottom: 1px solid black; color:white;">
            Inbound/Outbound
        </td>
        <td style="border-right: 1px solid white; background-color: #1F618D; font-weight: bold; border-bottom: 1px solid black; color:white;">
            Customer Status
        </td>
        <td style="border-right: 1px solid white; background-color: #1F618D; font-weight: bold; border-bottom: 1px solid black; color:white;">
            Customer Name
        </td>
        <td style="border-right: 1px solid white; background-color: #1F618D; font-weight: bold; border-bottom: 1px solid black; color:white;">
            Close Date
        </td>
        <td style="border-right: 1px solid white; background-color: #1F618D; font-weight: bold; border-bottom: 1px solid black; color:white;">
            Mount Code
        </td>
        <td style="border-right: 1px solid white; background-color: #1F618D; font-weight: bold; border-bottom: 1px solid black; color:white;">
            Revenue
        </td>
        <td style="border-right: 1px solid white; background-color: #1F618D; font-weight: bold; border-bottom: 1px solid black; color:white;">
            Wight
        </td>
        <td style="border-right: 1px solid white; background-color: #1F618D; font-weight: bold; border-bottom: 1px solid black; color:white;">
            Revenue
        </td>
        <td style="border-right: 1px solid white; background-color: #1F618D; font-weight: bold; border-bottom: 1px solid black; color:white;">
            Wight
        </td>
        <td style="border-right: 1px solid white; background-color: #1F618D; font-weight: bold; border-bottom: 1px solid black; color:white;">
            Revenue(%)
        </td>
        <td style="border-right: 1px solid white; background-color: #1F618D; font-weight: bold; border-bottom: 1px solid black; color:white;">
            Wight(%)
        </td>
    </tr>

{{--    @dd($mount_response);--}}
    @foreach($mount_response as $response)
        @php
            $api_key = '1db40f2c31f948d49073174ccea47e34';
            $esm_url = 'http://esm.lk/esm/api/v1/Opportunity/'.$response['id'];
            $esm_response = Http::withHeaders(['X-Api-Key' => $api_key])->get($esm_url);
        @endphp
        <tr>
            <td>
                {{$esm_response->json()['assignedUserName']}}
            </td>
            <td>
                {{$esm_response->json()['name']}}
            </td>
            <td>
                {{$esm_response->json()['inboundOutbound']}}
            </td>
            <td>
                {{$esm_response->json()['customerStatus']}}
            </td>
            <td>
                {{$esm_response->json()['accountName']}}
            </td>
            <td>
                {{$esm_response->json()['closeDate']}}
            </td>
            <td>
                @if($esm_response->json()['mountCode'] != null && $esm_response->json()['mountCode'] =! '')
                    {{$esm_response->json()['mountCode']}}
                @else
                    {{$esm_response->json()['mountCode1']}}
                @endif
            </td>
            <td>
                {{$esm_response->json()['customerPotentialRevenue']}}
            </td>
            <td>
                {{$esm_response->json()['customerPotentialWeight']}}
            </td>
            <td>
                {{$response['Revenue']}}
            </td>
            <td>
                {{$response['TotalWgt']}}
            </td>
            @php
                $revenue_percentage = $response['Revenue']/$esm_response->json()['customerPotentialRevenue']*100;
            if ($revenue_percentage <10)
                $revenue_color = '#FF0000';
            elseif ($revenue_percentage <80)
                $revenue_color = '#FFD800';
            elseif ($revenue_percentage <100)
                $revenue_color = '#0000FF';
            elseif ($revenue_percentage <200)
                $revenue_color = '#00FF00';
            else
                $revenue_color = '#00CC00';

            $wight_percentage = $response['TotalWgt']/$esm_response->json()['customerPotentialWeight']*100;

            if ($wight_percentage <10)
                $wight_color = '#ff0000';
            elseif ($wight_percentage <80)
                $wight_color = '#FFD800';
            elseif ($wight_percentage <100)
                $wight_color = '#0000ff';
            elseif ($wight_percentage <200)
                $wight_color = '#00FF00';
            else
                $wight_color = '#00CC00';
            @endphp
            <td style="color: {{$revenue_color}}">
                {{number_format((float)$revenue_percentage , 2, '.', ',').'%'}}
            </td>
            <td style="color: {{$wight_color}}">
                {{number_format((float)$wight_percentage , 2, '.', ',').'%'}}
            </td>
        </tr>
    @endforeach

</table>
