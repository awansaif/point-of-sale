<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Sr#</th>
              <th>Brand Name</th>
              <th>Description</th>
              <th>Action</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Sr#</th>
              <th>Brand Name</th>
              <th>Description</th>
              <th>Action</th>
            </tr>
          </tfoot>
          <tbody>
            @foreach($data as $key => $value)
            <tr>
              <td>{{ $key+1 }}</td>
              <td>{{ $value->name }}</td>
              <td>{{ $value->description }}</td>
              <td>
                <button class="btn btn-secondary btn-edit" data-id="{{ $value->id }}">Edit</button>
                <button class="btn btn-danger btn-delete" data-id="{{ $value->id }}">Delete</button>
              </td>
            </tr>
            @endforeach
          </tbody>
</table>