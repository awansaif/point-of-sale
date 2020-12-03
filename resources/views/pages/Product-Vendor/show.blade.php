<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
  <thead>
    <tr>
      <th>Vendor ID</th>
      <th>Vendor Name</th>
      <th>Phone</th>
      <th>Email</th>
      <th>Address</th>
      <th>Action</th>
    </tr>
  </thead>
  <tfoot>
    <tr>
      <th>Vendor ID</th>
      <th>Vendor Name</th>
      <th>Phone</th>
      <th>Email</th>
      <th>Address</th>
      <th>Action</th>
    </tr>
  </tfoot>
  <tbody>
    @foreach($data as $key => $value)
      <tr>
        <td>{{ $key+1 }}</td>
        <td>{{ $value->name }}</td>
        <td>{{ $value->contact }}</td>
        <td>{{ $value->email }}</td>
        <td>{{ $value->address }}</td>
        <td>
          <button class="btn btn-secondary btn-edit" data-id="{{ $value->id }}">Edit</button>
          <button class="btn btn-danger btn-delete" data-id="{{ $value->id }}">Remove</button>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>