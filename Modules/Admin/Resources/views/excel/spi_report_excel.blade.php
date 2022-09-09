<table style="font-family: Calibri; border: 1px solid black; border-collapse: collapse;">
    <tr>
        <td style="background-color: #EC9328;"></td>
        <td style="background-color: #EC9328;  text-align: left" colspan="2">
            <b>SALES PERFORMANCE INDEX (SPI)</b></td>
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
        <td>{{$report_year.' '.\Carbon\Carbon::createFromFormat('m', $report_month)->format('F')}}</td>
        <td><b>Mountain hawk express</b></td>
        @foreach($sales_persons as $sales_person)

            <td style="background-color: #34e3fd;  text-align: left" colspan="3">
                {{$sales_person[0]->salutation_name.' '.$sales_person[0]->first_name.' '.$sales_person[0]->last_name}}
            </td>
        @endforeach
    </tr>
    <tr>
        <td style="border-right: 1px solid white; background-color: #1F618D; font-weight: bold; border-bottom: 1px solid black; color:white;">
            KPI
        </td>
        <td style="border-right: 1px solid white; background-color: #1F618D; font-weight: bold; border-bottom: 1px solid black; color:white;">
            Definition
        </td>
        @for($i = 0; $i<count($sales_persons); $i++)
            <td style="border-right: 1px solid white; background-color: #1F618D; font-weight: bold; border-bottom: 1px solid black; color:white;">
                Target
            </td>
            <td style="border-right: 1px solid white; background-color: #1F618D; font-weight: bold; border-bottom: 2px solid black; color:white;">
                Achievement
            </td>
            <td style="border-right: 1px solid white; background-color: #1F618D; font-weight: bold; border-bottom: 1px solid black; color:white;">
                %
            </td>
        @endfor
    </tr>
        @foreach($targets as $target)
            <tr>
                <td style="border: 1px solid black;">{{$target['name']}}</td>
                <td style="border: 1px solid black;">{{$target['description']}}</td>
                @for( $i = 0;  $i < count($sales_persons);  $i++)
                    <td style="border: 1px solid black;">{{$target['prefix'].$target[$i]['target'] ?? ''}}</td>
                    <td style="border: 1px solid black;">{{$target['prefix'].$target[$i]['achievement']?? ''}}</td>
                    <td style="border: 1px solid black;">{{$target[$i]['percentage'].'%'?? '' }}</td>
                @endfor
            </tr>
        @endforeach
</table>
