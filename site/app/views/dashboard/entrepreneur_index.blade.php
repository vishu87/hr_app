@include('header')
@include('navigation')
<main>
    <div class="container">
        <div class="dashboard_ent">
            @include('admin.entrepreneur.form')
        </div>
    </div>
    @include('copyright')
</main>
@include('footer')