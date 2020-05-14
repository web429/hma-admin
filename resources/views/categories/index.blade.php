@extends('layouts.app', ['activePage' => 'category-management', 'menuParent' => 'characteristics', 'titlePage' => __('Item Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">category</i>
                </div>
                <h4 class="card-title">{{ __('Heavy Equipment Categories') }}</h4>
              </div>
              <div class="card-body">
                @can('create', App\Category::class)
                  <div class="row">
                    <div class="col-12 text-right">
                      <a href="{{ route('category.create') }}" class="btn btn-sm btn-rose">{{ __('Add category') }}</a>
                    </div>
                  </div>
                @endcan
                <div class="table-responsive">
                  <table id="datatables" class="table table-striped table-no-bordered table-hover datatable-rose" style="display:none">
                    <thead class="text-primary">
                      <th>
                          {{ __('Name') }}
                      </th>
                      <th>
                          {{ __('Type') }}
                      </th>
                      <th>
                        {{ __('Description') }}
                      </th>
                      <th>
                        {{ __('Truck Mounted') }}
                      </th>
                      <th>
                        {{ __('Specific Data Field') }}
                      </th>
                      <th>
                        {{ __('Creation date') }}
                      </th>
                      @can('manage-items', App\User::class)
                        <th class="text-right">
                          {{ __('Actions') }}
                        </th>
                      @endcan
                    </thead>
                    <tbody>
                      @foreach($categories as $category)
                        <tr>
                          <td>
                            {{ $category->name }}
                          </td>
                          <td>
                            {{ $category->type->name }}
                          </td>
                          <td>
                            {{ $category->description }}
                          </td>
                          <td>
                          @if ($category->truck_mounted == 1)
                            <span class="badge badge-success">Yes</span>
                          @else
                            <span class="badge badge-warning">No</span>
                          @endif
                          </td>
                          <td>
                            @foreach ($category->specifics as $specific)
                                <span class="badge badge-default">{{ $specific->name }} {{ $specific->unit != '' ? '('.$specific->unit.')' : "" }}</span>
                            @endforeach
                          </td>
                          <td>
                            {{ $category->created_at->format('Y-m-d') }}
                          </td>
                          @can('manage-items', App\User::class)
                            <td class="td-actions text-right">
                              <form action="{{ route('category.destroy', $category) }}" method="post">
                                @csrf
                                @method('delete')
                                
                                @can('update', $category)
                                  <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('category.edit', $category) }}" data-original-title="" title="">
                                    <i class="material-icons">edit</i>
                                    <div class="ripple-container"></div>
                                  </a>
                                @endcan
                                @if (auth()->user()->can('delete', $category))
                                  <button type="button" class="btn btn-danger btn-link" data-original-title="" title="" onclick="confirm('{{ __("Are you sure you want to delete this category?") }}') ? this.parentElement.submit() : ''">
                                      <i class="material-icons">close</i>
                                      <div class="ripple-container"></div>
                                  </button>
                                @endif
                              </form>
                            </td>
                          @endcan
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('js')
  <script>
    $(document).ready(function() {
      $('#datatables').fadeIn(1100);
      $('#datatables').DataTable({
        "pagingType": "full_numbers",
        "lengthMenu": [
          [10, 25, 50, -1],
          [10, 25, 50, "All"]
        ],
        responsive: true,
        language: {
          search: "_INPUT_",
          searchPlaceholder: "Search categories",
        },
        "columnDefs": [
          { "orderable": false, "targets": 3 },
        ],
      });
    });
  </script>
@endpush