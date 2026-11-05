<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { dashboard, login, register } from '@/routes';

defineOptions({
    layout: [],
});
</script>

<template>
    <Head title="Game Guide Library" />

    <div class="homepage">
        <header class="site-header">
            <Link href="/" class="brand">
                Game Guide Library
            </Link>

            <nav aria-label="Main navigation">
                <Link href="/games" class="nav-link">
                    Games
                </Link>

                <Link
                    v-if="$page.props.auth.user"
                    :href="dashboard()"
                    class="primary-button"
                >
                    Dashboard
                </Link>

                <template v-else>
                    <Link :href="login()" class="nav-link">
                        Log in
                    </Link>

                    <Link :href="register()" class="primary-button">
                        Register
                    </Link>
                </template>
            </nav>
        </header>

        <main>
            <section class="hero">
                <p class="eyebrow">A LITTLE GUIDANCE FOR YOUR NEXT ADVENTURE</p>

                <h1>
                    Your next game.<br />
                    <span>Your first steps.</span>
                </h1>

                <p class="hero-description">
                    Find beginner guides for your favorite games.
                    From building your first shelter to starting your farm,
                    discover where to begin.
                </p>

                <div class="hero-actions">
                    <Link href="/games" class="primary-button">
                        Browse Games →
                    </Link>

                    <Link
                        v-if="!$page.props.auth.user"
                        :href="login()"
                        class="secondary-button"
                    >
                        Log in
                    </Link>

                    <Link
                        v-else
                        :href="dashboard()"
                        class="secondary-button"
                    >
                        Go to Dashboard
                    </Link>
                </div>

                <p class="browse-note">
                    You can browse guides without an account.
                </p>
            </section>

            <section class="features" aria-label="Explore the library">
                <article>
                    <span class="feature-number">01</span>
                    <h2>Find your game</h2>
                    <p>
                        Search the library and choose the game you want
                        to explore.
                    </p>
                </article>

                <article>
                    <span class="feature-number">02</span>
                    <h2>Follow the steps</h2>
                    <p>
                        Read simple walkthroughs that help you get
                        started.
                    </p>
                </article>

                <article>
                    <span class="feature-number">03</span>
                    <h2>Start your adventure</h2>
                    <p>
                        Take what you have learned into your next
                        play session.
                    </p>
                </article>
            </section>
        </main>

        <footer>
            Game Guide Library · A place to start exploring.
        </footer>
    </div>
</template>

<style scoped>
.homepage {
    min-height: 100vh;
    background: #ffffff;
    color: #172033;
    font-family: Arial, sans-serif;
}

.homepage *,
.homepage *::before,
.homepage *::after {
    box-sizing: border-box;
}

.site-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 24px;
    max-width: 1168px;
    margin: 0 auto;
    padding: 24px;
    border-bottom: 1px solid #e8eaf0;
}

.brand {
    color: #172033;
    font-size: 19px;
    font-weight: 800;
    text-decoration: none;
}

nav {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 20px;
}

.nav-link {
    color: #526075;
    font-size: 14px;
    font-weight: 700;
    text-decoration: none;
}

.nav-link:hover {
    color: #6d28d9;
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
    border-color: #ddd6fe;
    background: #ffffff;
    color: #6d28d9;
}

.secondary-button:hover {
    background: #f5f3ff;
}

.hero {
    padding: 88px 24px 72px;
    background: linear-gradient(180deg, #ffffff 0%, #f5f3ff 100%);
    text-align: center;
}

.eyebrow {
    margin: 0 0 24px;
    color: #6d28d9;
    font-size: 11px;
    font-weight: 700;
    line-height: 1.8;
    letter-spacing: 1.6px;
}

h1 {
    margin: 0;
    color: #172033;
    font-size: clamp(40px, 7vw, 76px);
    font-weight: 800;
    line-height: 1.08;
    letter-spacing: -2px;
}

h1 span {
    color: #6d28d9;
}

.hero-description {
    max-width: 560px;
    margin: 28px auto 0;
    color: #526075;
    font-size: 17px;
    line-height: 1.8;
}

.hero-actions {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 14px;
    margin-top: 32px;
}

.browse-note {
    margin: 20px 0 0;
    color: #647084;
    font-size: 13px;
}

.features {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 24px;
    max-width: 1168px;
    margin: 0 auto;
    padding: 56px 24px;
}

.features article {
    padding: 28px;
    border: 1px solid #e1e4ed;
    border-radius: 16px;
    background: #ffffff;
    box-shadow: 0 5px 18px rgb(23 32 51 / 5%);
}

.feature-number {
    color: #6d28d9;
    font-size: 14px;
    font-weight: 800;
}

.features h2 {
    margin: 18px 0 12px;
    color: #172033;
    font-size: 20px;
    font-weight: 700;
}

.features p {
    margin: 0;
    color: #647084;
    font-size: 15px;
    line-height: 1.8;
}

footer {
    padding: 24px;
    border-top: 1px solid #e8eaf0;
    color: #647084;
    font-size: 13px;
    text-align: center;
}

a:focus-visible {
    outline: 3px solid #7c3aed;
    outline-offset: 4px;
}

@media (max-width: 700px) {
    .site-header {
        flex-direction: column;
        align-items: flex-start;
    }

    nav {
        gap: 16px;
    }

    .hero {
        padding: 56px 20px;
    }

    .features {
        grid-template-columns: 1fr;
        padding: 32px 20px;
    }
}
</style>