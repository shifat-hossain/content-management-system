<div class="nav">
    <div class="sb-sidenav-menu-heading">Core</div>
    <a class="nav-link" href="{{ route(auth()->user()->role.'.dashboard') }}">
        <div class="sb-nav-link-icon">
            <i class="fas fa-tachometer-alt"></i>
        </div>
        Dashboard
    </a>
    
    
    @if (auth()->user()->role == 'admin')
        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#category"
            aria-expanded="false" aria-controls="category">
            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
            Category
            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
        </a>
    
        <div class="collapse" id="category" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link" href="{{ route('admin.categories.create') }}">
                    Add Category
                </a>
                <a class="nav-link" href="{{ route('admin.categories.index') }}">
                    All Category
                </a>
            </nav>
        </div>
    @endif

    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#posts"
        aria-expanded="false" aria-controls="posts">
        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
        Posts
        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
    </a>
    <div class="collapse" id="posts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
        <nav class="sb-sidenav-menu-nested nav">
            <a class="nav-link" href="{{ route(auth()->user()->role.'.posts.create') }}">
                Add Post
            </a>
            <a class="nav-link" href="{{ route(auth()->user()->role.'.posts.index') }}">
                All Post
            </a>
        </nav>
    </div>
</div>
