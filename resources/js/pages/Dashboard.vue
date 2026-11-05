<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { dashboard } from '@/routes';

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Dashboard',
                href: dashboard(),
            },
        ],
    },
});
</script>

<template>
    <Head title="Dashboard" />

    <main class="dashboard-page">
        <div class="dashboard-container">
            <header class="welcome-panel">
                <p class="eyebrow">YOUR GAME GUIDE LIBRARY</p>

                <h1>
                    Welcome back, {{ $page.props.auth.user.name }}!
                </h1>

                <p class="welcome-description">
                    Explore a guide or add your next game to the library.
                </p>

                <Link href="/games" class="primary-button">
                    Browse Games →
                </Link>
            </header>

            <section class="actions-section" aria-labelledby="actions-heading">
                <h2 id="actions-heading">Where would you like to go?</h2>

                <div class="action-grid">
                    <Link href="/games" class="action-card">
                        <span class="card-label">EXPLORE</span>
                        <h3>Game Library</h3>
                        <p>
                            Search your games and open their beginner guides.
                        </p>
                        <span class="card-link">View games →</span>
                    </Link>

                    <Link
                        href="/games/create"
                        class="action-card teal-card"
                    >
                        <span class="card-label">BUILD YOUR COLLECTION</span>
                        <h3>Add a Game</h3>
                        <p>
                            Add a game title and genre to your collection.
                        </p>
                        <span class="card-link">Add game →</span>
                    </Link>

                    <Link href="/" class="action-card amber-card">
                        <span class="card-label">HOME</span>
                        <h3>Visit Homepage</h3>
                        <p>
                            Return to the front page of your guide library.
                        </p>
                        <span class="card-link">Go home →</span>
                    </Link>
                </div>
            </section>

            <section class="getting-started">
                <div>
                    <p class="eyebrow">PICK UP A GUIDE</p>
                    <h2>A small step toward your next adventure</h2>
                    <p>
                        Open the game library, choose a game, and select
                        View Guide to follow its walkthrough.
                    </p>
                </div>

                <Link href="/games" class="secondary-button">
                    Find a Guide →
                </Link>
            </section>
        </div>
    </main>
</template>

<style scoped>
.dashboard-page {
    flex: 1;
    min-width: 0;
    padding: 32px;
    background: #ffffff;
    color: #172033;
    font-family: Arial, sans-serif;
}

.dashboard-page *,
.dashboard-page *::before,
.dashboard-page *::after {
    box-sizing: border-box;
}

.dashboard-container {
    max-width: 1120px;
    margin: 0 auto;
}

.welcome-panel {
    padding: 40px;
    border: 1px solid #e5ddfa;
    border-radius: 20px;
    background: linear-gradient(120deg, #f5f3ff, #ffffff);
}

.eyebrow {
    margin: 0 0 14px;
    color: #6d28d9;
    font-size: 11px;
    font-weight: 800;
    line-height: 1.7;
    letter-spacing: 1.5px;
}

h1 {
    margin: 0;
    color: #172033;
    font-size: clamp(28px, 4vw, 40px);
    font-weight: 800;
    line-height: 1.2;
    letter-spacing: -1px;
    overflow-wrap: anywhere;
}

.welcome-description {
    margin: 16px 0 24px;
    color: #647084;
    font-size: 16px;
    line-height: 1.7;
}

.primary-button,
.secondary-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 13px 20px;
    border: 1px solid transparent;
    border-radius: 10px;
    font-size: 14px;
    font-weight: 700;
    text-decoration: none;
}

.primary-button {
    background: #6d28d9;
    color: #ffffff;
}

.primary-button:hover {
    background: #5b21b6;
}

.secondary-button {
    flex-shrink: 0;
    border-color: #ddd6fe;
    background: #ffffff;
    color: #6d28d9;
}

.secondary-button:hover {
    background: #f5f3ff;
}

.actions-section {
    margin-top: 36px;
}

h2 {
    margin: 0;
    color: #172033;
    font-size: 22px;
    font-weight: 700;
    line-height: 1.4;
}

.action-grid {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 20px;
    margin-top: 20px;
}

.action-card {
    display: flex;
    flex-direction: column;
    padding: 28px;
    border: 1px solid #e1e4ed;
    border-top: 5px solid #7c3aed;
    border-radius: 14px;
    background: #ffffff;
    text-decoration: none;
    box-shadow: 0 5px 18px rgb(23 32 51 / 5%);
    transition:
        transform 0.2s,
        box-shadow 0.2s;
}

.action-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 28px rgb(23 32 51 / 10%);
}

.card-label {
    color: #6d28d9;
    font-size: 10px;
    font-weight: 800;
    line-height: 1.6;
    letter-spacing: 1px;
}

.action-card h3 {
    margin: 18px 0 12px;
    color: #172033;
    font-size: 22px;
    font-weight: 700;
}

.action-card p {
    margin: 0 0 28px;
    color: #647084;
    font-size: 14px;
    line-height: 1.8;
}

.card-link {
    margin-top: auto;
    color: #6d28d9;
    font-size: 14px;
    font-weight: 700;
}

.teal-card {
    border-top-color: #0d9488;
}

.teal-card .card-label,
.teal-card .card-link {
    color: #0f766e;
}

.amber-card {
    border-top-color: #d97706;
}

.amber-card .card-label,
.amber-card .card-link {
    color: #92400e;
}

.getting-started {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 28px;
    margin-top: 32px;
    padding: 32px;
    border: 1px solid #e8eaf0;
    border-radius: 16px;
    background: #f8f9fc;
}

.getting-started p:last-child {
    max-width: 580px;
    margin: 12px 0 0;
    color: #647084;
    font-size: 14px;
    line-height: 1.8;
}

a:focus-visible {
    outline: 3px solid #7c3aed;
    outline-offset: 4px;
}

@media (max-width: 1000px) {
    .action-grid {
        grid-template-columns: 1fr;
    }

    .getting-started {
        flex-direction: column;
        align-items: flex-start;
    }
}

@media (max-width: 600px) {
    .dashboard-page {
        padding: 20px 16px;
    }

    .welcome-panel {
        padding: 28px 22px;
    }

    .action-card,
    .getting-started {
        padding: 24px;
    }
}

@media (prefers-reduced-motion: reduce) {
    .action-card {
        transition: none;
    }

    .action-card:hover {
        transform: none;
    }
}
</style>