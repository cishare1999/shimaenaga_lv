<table>
  <tr>
    <th>id</th>
    <th>user_id</th>
    <th>user_name</th>
    <th>user_mobile</th>
    <th>user_email</th>
    <th>way</th>
    <th>item_name</th>
    <th>condition</th>
    <th>comment</th>
    <th>price</th>
    <th>price_more </th>
    <th>item_image1</th>
    <th>item_image2</th>
    <th>item_image3</th>
    <th>status_total</th>
    <th>judge_price</th>
    <th>user_agree</th>
    <th>created_at</th>
    <th>updated_at</th>
  </tr>

  @foreach($data as $item)
  <tr>
    <td>{{ $item->id }}</td>
    <td>{{ $item->user_id }}</td>
    <td>{{ $item->user->name }}</td>
    <td>{{ $item->user->mobile }}</td>
    <td>{{ $item->user->email }}</td>
    <td>{{ $item->way }}</td>
    <th>{{ $item->item_name }}</th>
    <th>{{ $item->condition }}</th>
    <th>{{ $item->comment }}</th>
    <th>{{ $item->price }}</th>
    <th>{{ $item->price_more  }}</th>
    <th>{{ $item->item_image1 }}</th>
    <th>{{ $item->item_image2 }}</th>
    <th>{{ $item->item_image3 }}</th>
    <th>{{ $item->status_total }}</th>
    <th>{{ $item->judge_price }}</th>
    <th>{{ $item->user_agree }}</th>
    <th>{{ $item->created_at }}</th>
    <th>{{ $item->updated_at }}</th>
  </tr>
  @endforeach
</table>