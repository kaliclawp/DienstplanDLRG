@extends('_layouts.application')

@section('head')
    <link rel="stylesheet" href="/plugins/bootstrap-table/bootstrap-table.min.css">
@endsection

@section('content')
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Dienst Historie Export
                </h2>
                <ul class="header-dropdown m-r--5">
                    <li>
                        <a href="{{ route('service.history') }}" class="btn btn-default waves-effect">
                            <i class="material-icons">arrow_back</i> Zurück zur Historie
                        </a>
                    </li>
                </ul>
            </div>
            <div class="body table-responsive">
                <table data-toggle="table" class="table table-striped table-hover"
                       data-show-toggle="true"
                       data-show-columns="true"
                       data-search="true"
                       data-search-highlight="true"
                       data-show-search-clear-button="true"
                       data-cookie="true"
                       data-cookie-id-table="serviceHistoryExport"
                       data-filter-control="true"
                       data-show-export="true"
                       @if(!Browser::isDesktop())
                       data-card-view="true"
                       @endif
                >
                    <thead>
                    <tr>
                        <th data-sortable="true" data-field="Datum" data-filter-control="input">Datum</th>
                        <th data-sortable="true" data-field="Uhrzeit" data-filter-control="input">Uhrzeit</th>
                        <th data-sortable="true" data-field="Ende" data-filter-control="input">Ende</th>
                        <th data-sortable="true" data-field="Kommentar" data-filter-control="input">Kommentar</th>
                        <th data-sortable="true" data-field="Ort" data-filter-control="input">Ort</th>
                        <th data-sortable="true" data-field="Abgeschlossen" data-filter-control="select">Abgeschlossen</th>
                        <th data-sortable="true" data-field="Qualifikation" data-filter-control="input">Qualifikation</th>
                        <th data-sortable="true" data-field="Pflichtposition" data-filter-control="select">Pflichtposition</th>
                        <th data-sortable="true" data-field="Person" data-filter-control="input">Person</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($services as $service)
                        @foreach($service->positions as $position)
                            <tr>
                                <td>{{ $service->date->format('d.m.Y') }}</td>
                                <td>{{ $service->date->format('H:i') }}</td>
                                <td>{{ !empty($service->dateEnd) ? $service->dateEnd->format('d.m.Y H:i') : '' }}</td>
                                <td>{{ $service->comment }}</td>
                                <td>{{ $service->location }}</td>
                                <td>{{ !empty($service->finalized_at) ? 'Ja' : 'Nein' }}</td>
                                <td>{{ $position->qualification->name }}</td>
                                <td>{{ $position->requiredposition ? 'Ja' : 'Nein' }}</td>
                                <td>{{ isset($position->user) ? $position->user->first_name . ' ' . $position->user->name : '' }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('post_body')
    <script src="/plugins/bootstrap-table/bootstrap-table.min.js"></script>
    <script src="/plugins/bootstrap-table/extensions/filter-control/bootstrap-table-filter-control.min.js"></script>
    <script src="/plugins/bootstrap-table/extensions/cookie/bootstrap-table-cookie.min.js"></script>

    <script src="/plugins/jquery-tableexport/tableExport.min.js"></script>
    <script src="/plugins/bootstrap-table/extensions/export/bootstrap-table-export.js"></script>

    <script>
        $(document).ready(function () {
            $('.table').bootstrapTable({});
        });
    </script>
@endsection
