@extends('admin.layouts.index')
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <!-- Pick PAGE CONTENT-->
            <div class="pick-page">
                <h2>Pick a plan</h2>

                <div class="columns plan-card-column">
                    <div class="plan-card-container">
                        <article class="card">
                            <div class="card-body">
                                <h1 class="plan-name">Standard</h1>
                                <br class="plan-card-price-starting-at">
                                <div class="plan-price">
                                    <span class="plan-price-currency">$</span>
                                    <span class="plan-price-integer-part">29</span>
                                    <span class="plan-price-fractional-part">.95</span>
                                    <span class="plan-price-separator">/</span>
                                    <span class="plan-price-frequency">mo</span>
                                </div>
                                <p class="plan-card-description">A full-featured online store</p>
                            </div>
                            <footer class="card-footer">
                                <form >
                                    <input type="submit" name="commit" value="Select plan" class="button button card-button button-primary">
                                </form>

                            </footer>
                        </article>
                    </div>

                </div>
            </div>
            <!-- END PAGE CONTENT-->
        </div>
    </div>
@endsection