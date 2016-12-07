@extends('super_admin.layouts.index')

    @section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">Dashboard</h1>

        <div class="row">
            <div class="col-md-6 search_section">
                <form action="{{ url('super_admin/search') }}" method="get">
                    <div class="form-group form-inline">
                        <input type="text" name="search" class="form-control search search_section-input" placeholder="Restaurant ID">
                        <button type="submit" class="btn btn-success submit_btn search-btn">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection

