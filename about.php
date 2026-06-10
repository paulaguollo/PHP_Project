<?php
session_start();
require_once 'includes/header.php';
?>

<div class="container py-5">

    <!-- About Grove -->
    <div class="row align-items-center mb-5">
        <div class="col-md-7">
            <h2 class="mb-3">About Grove</h2>
            <p>Grove is a collaborative web platform where individuals, communities and organizations can publish, discover and join sustainable impact initiatives from community gardens to solar energy projects, local recycling campaigns and circular economy efforts.</p>
            <p>The platform is built around one idea: no impact grows alone. People who want to act need to find projects that need support. Grove connects both sides.</p>
            <p class="text-muted">Each initiative has a location, a category and an impact description defined by its creator. Anyone can browse and discover initiatives. Registered users can create their own or join others as collaborators.</p>
        </div>
        <div class="col-md-5 text-center d-none d-md-block">
           <img src="/assets/img/community-2.png" alt="Community" class="img-fluid rounded-4" style="max-width: 500px;">
        </div>
    </div>

    <hr style="border-color: var(--color-border);">

    <!-- How it works -->
    <div class="row mt-5 mb-5">
        <div class="col-12 mb-4">
            <h4>How it works</h4>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card p-4 h-100">
                <i class="bi bi-search mb-3" style="font-size: 1.8rem; color: var(--color-primary-mid);"></i>
                <h5 class="card-title">Discover</h5>
                <p class="text-muted mb-0">Browse initiatives by category or location. Find projects that match your values and interests.</p>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card p-4 h-100">
                <i class="bi bi-people mb-3" style="font-size: 1.8rem; color: var(--color-primary-mid);"></i>
                <h5 class="card-title">Join</h5>
                <p class="text-muted mb-0">Register and join initiatives as a collaborator. Track your participations from your profile.</p>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card p-4 h-100">
                <i class="bi bi-plus-circle mb-3" style="font-size: 1.8rem; color: var(--color-primary-mid);"></i>
                <h5 class="card-title">Create</h5>
                <p class="text-muted mb-0">Have an idea? Publish your own initiative, describe its impact and invite others to collaborate.</p>
            </div>
        </div>
    </div>

    <hr style="border-color: var(--color-border);">

    <!-- Creator -->
    <div class="row align-items-center mt-5">
        <div class="col-md-2 text-center mb-3 mb-md-0">
            <img src="/assets/img/profile.png" alt="Paula Guollo" class="rounded-circle" style="width: 90px; height: 90px; object-fit: cover; border: 3px solid var(--color-surface-warm);">
        </div>
        <div class="col-md-7">
            <h5 class="mb-1">Paula Guollo</h5>
            <p class="text-muted mb-2" style="font-size: 0.85rem;">Economics &amp; Sustainability · Web Development at CESAE Digital</p>
            <p class="text-muted mb-0" style="font-size: 0.875rem;">Grove was built as a final project combining a background in economics and sustainability with back-end web development. Co-founder <a href="https://impactflow.pt" target="_blank" style="color: var(--color-primary-mid);">Impact Flow</a>, a SaaS platform for social impact training programmes.</p>
        </div>
        <div class="col-md-3 text-md-end mt-3 mt-md-0">
            <div class="d-flex justify-content-center justify-content-md-end gap-3">
                <a href="https://github.com/paulaguollo" target="_blank" class="text-decoration-none" style="color: var(--color-text);">
                    <i class="bi bi-github" style="font-size: 1.3rem;"></i>
                </a>
                <a href="https://www.linkedin.com/in/paula-guollo" target="_blank" class="text-decoration-none" style="color: var(--color-text);">
                    <i class="bi bi-linkedin" style="font-size: 1.3rem;"></i>
                </a>
                <a href="mailto:paulaguollo00@gmail.com" class="text-decoration-none" style="color: var(--color-text);">
                    <i class="bi bi-envelope" style="font-size: 1.3rem;"></i>
                </a>
            </div>
        </div>
    </div>

</div>

<?php require_once 'includes/footer.php'; ?>