<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="/">Laito</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/pages/about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/pages/contact">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/komik">Komik</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/orang">Member</a>
                </li>
                <?php if(logged_in()): ?>
                <li class="nav-item">
                    <a class="nav-link" href="/user">My Profile</a>
                </li>
                <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="/login">Login</a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>