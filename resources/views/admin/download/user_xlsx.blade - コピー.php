<table>
  <tr>
    <th>id</th>
    <th>from_url</th>
    <th>name</th>
    <th>kana</th>
    <th>mobile</th>
    <th>email</th>
    <th>email_verified_at</th>
    <th>user_created_at</th>
    <th>user_updated_at</th>
    <th>line</th>
    <th>contact</th>
    <th>zip</th>
    <th>pref</th>
    <th>city</th>
    <th>address</th>
    <th>building</th>
    <th>bank_name</th>
    <th>bank_code</th>
    <th>branch_name</th>
    <th>branch_code</th>
    <th>bank_type</th>
    <th>bank_number</th>
    <th>bank_kana</th>
    <th>licence_1</th>
    <th>licence_2</th>
    <th>licence_3</th>
    <th>work_name</th>
    <th>work_tel</th>
    <th>work_zip</th>
    <th>work_pref</th>
    <th>work_city</th>
    <th>work_address</th>
    <th>work_building</th>
    <th>salary</th>
    <th>payday</th>
    <th>memo</th>
    <th>is_black</th>
    <th>data_created_at</th>
    <th>data_updated_at</th>
  </tr>

  @foreach($data as $item)
  <tr>
    <td>{{ $item->id }}</td>
    <td>{{ $item->from_url }}</td>
    <td>{{ $item->name }}</td>
    <td>{{ optional($item->userData)->kana }}</td>
    <td>{{ $item->mobile }}</td>
    <td>{{ $item->email }}</td>
    <td>{{ $item->email_verified_at }}</td>
    <td>{{ $item->created_at }}</td>
    <td>{{ $item->updated_at }}</td>
    <td>{{ optional($item->userData)->line }}</td>
    <td>{{ optional($item->userData)->contact }}</td>
    <td>{{ optional($item->userData)->zip }}</td>
    <td>{{ optional($item->userData)->pref }}</td>
    <td>{{ optional($item->userData)->city }}</td>
    <td>{{ optional($item->userData)->address }}</td>
    <td>{{ optional($item->userData)->building }}</td>
    <td>{{ optional($item->userData)->bank_name }}</td>
    <td>{{ optional($item->userData)->bank_code }}</td>
    <td>{{ optional($item->userData)->branch_name }}</td>
    <td>{{ optional($item->userData)->branch_code }}</td>
    <td>{{ optional($item->userData)->bank_type }}</td>
    <td>{{ optional($item->userData)->bank_number }}</td>
    <td>{{ optional($item->userData)->bank_kana }}</td>
    <td>{{ optional($item->userData)->licence_1 }}</td>
    <td>{{ optional($item->userData)->licence_2 }}</td>
    <td>{{ optional($item->userData)->licence_3 }}</td>
    <td>{{ optional($item->userData)->work_name }}</td>
    <td>{{ optional($item->userData)->work_tel }}</td>
    <td>{{ optional($item->userData)->work_zip }}</td>
    <td>{{ optional($item->userData)->work_pref }}</td>
    <td>{{ optional($item->userData)->work_city }}</td>
    <td>{{ optional($item->userData)->work_address }}</td>
    <td>{{ optional($item->userData)->work_building }}</td>
    <td>{{ optional($item->userData)->salary }}</td>
    <td>{{ optional($item->userData)->payday }}</td>
    <td>{{ optional($item->userData)->memo }}</td>
    <td>{{ optional($item->userData)->is_black }}</td>
    <td>{{ optional($item->userData)->created_at }}</td>
    <td>{{ optional($item->userData)->updated_at }}</td>
  </tr>
  @endforeach
</table>