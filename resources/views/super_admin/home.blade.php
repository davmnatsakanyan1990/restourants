@extends('super_admin.layouts.index')

    @section('content')
    <div class="main">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <h1 class="page-header">Dashboard</h1>
                <form action="{{ url('super_admin/search') }}" method="get">
                    <div class="form-group form-inline">
                        <input type="text" name="search" style="border: 1px solid #8c8c8c; border-radius: 0;" class="form-control search search_section-input" placeholder="Restaurant ID">
                        <button type="submit" style="border-radius: 0; border: 1px solid #00897B; background-color: #00897B" class="btn btn-success submit_btn search-btn">Search</button>
                    </div>
                </form>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
    @endsection

