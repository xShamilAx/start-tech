<table>

    <tr>
        @for( $i = 0;  $i < count($heading);  $i++)
            <th>
                "{{$heading[$i]}}"|
            </th>
        @endfor
            <th>
               |
            </th>
    </tr>

    @foreach($data_sets as $data_set)
        <tr>
        @for( $i = 0;  $i < count($data_set);  $i++)
            <td>
                "{{$data_set[$heading[$i]]}}"|
            </td>
        @endfor
            <td>
               |
            </td>
        </tr>
    @endforeach

</table>
