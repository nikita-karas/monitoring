@extends('layouts.voler')
@section('content')
    <div class="page-title">
        <h3>Servers</h3>
        <p class="text-subtitle text-muted">Synergistically exploit highly efficient materials through real-time
            systems. Holisticly synergize.</p>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                Simple Datatable
            </div>
            <div class="card-body">
                <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                    <div class="dataTable-top">
                        <div class="dataTable-dropdown"><select class="dataTable-selector form-select">
                                <option value="5">5</option>
                                <option value="10" selected="">10</option>
                                <option value="15">15</option>
                                <option value="20">20</option>
                                <option value="25">25</option>
                            </select><label>entries per page</label></div>
                        <div class="dataTable-search"><input class="dataTable-input" placeholder="Search..."
                                                             type="text"></div>
                    </div>
                    <div class="dataTable-container">
                        <table class="table table-striped dataTable-table" id="table1">
                            <thead>
                            <tr>
                                <th data-sortable="" style="width: 32.4493%;"><a href="#"
                                                                                 class="dataTable-sorter">Name</a></th>
                                <th data-sortable="" style="width: 91.6069%;"><a href="#"
                                                                                 class="dataTable-sorter">Email</a></th>
                                <th data-sortable="" style="width: 29.2044%;"><a href="#"
                                                                                 class="dataTable-sorter">Phone</a></th>
                                <th data-sortable="" style="width: 38.6895%;"><a href="#"
                                                                                 class="dataTable-sorter">City</a></th>
                                <th data-sortable="" style="width: 31.4509%;"><a href="#" class="dataTable-sorter">Status</a>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Graiden</td>
                                <td>vehicula.aliquet@semconsequat.co.uk</td>
                                <td>076 4820 8838</td>
                                <td>Offenburg</td>
                                <td>
                                    <span class="badge bg-success">Active</span>
                                </td>
                            </tbody>
                        </table>
                    </div>
                    <div class="dataTable-bottom">
                        <div class="dataTable-info">Showing 1 to 25 of 26 entries</div>
                        <ul class="pagination pagination-primary float-right dataTable-pagination">
                            <li class="page-item pager"><a href="#" class="page-link" data-page="1">‹</a></li>
                            <li class="page-item active"><a href="#" class="page-link" data-page="1">1</a></li>
                            <li class="page-item"><a href="#" class="page-link" data-page="2">2</a></li>
                            <li class="page-item pager"><a href="#" class="page-link" data-page="2">›</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
