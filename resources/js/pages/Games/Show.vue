<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';

defineOptions({
    layout: [],
});

defineProps<{
    game: {
        id: number;
        title: string;
    };
    guides: {
        id: string;
        title: string;
        steps: string[];
    }[];
}>();
</script>

<template>
    <Head :title="`${game.title} Guides`" />

    <main>
        <div class="page-container">
            <Link href="/games" class="back-link">
                ← Back to games
            </Link>

            <header class="guide-header">
                <span class="game-badge">{{ game.title }}</span>

                <h1>Game guides</h1>

                <p class="subtitle">
                    Choose a walkthrough and start exploring.
                </p>

                <p class="step-count">
                    {{ guides.length }}
                    {{ guides.length === 1 ? 'guide' : 'guides' }}
                </p>

                <Link
                    v-if="$page.props.auth.user"
                    :href="`/games/${game.id}/guides/create`"
                    class="browse-button add-guide-button"
                >
                    + Add Guide
                </Link>
            </header>

            <p v-if="guides.length === 0" class="empty-message">
                No guides yet for this game.
            </p>

            <section
                v-for="guide in guides"
                :key="guide.id"
                class="guide-content"
                :aria-labelledby="`guide-${guide.id}`"
            >
                <div class="guide-heading">
    <h2 :id="`guide-${guide.id}`">
        {{ guide.title }}
    </h2>

    <Link
        v-if="$page.props.auth.user"
        :href="`/guides/${guide.id}/edit`"
        class="edit-button"
    >
        Edit Guide
    </Link>
</div>

                <ol class="steps-list">
                    <li
                        v-for="(step, index) in guide.steps"
                        :key="index"
                        class="step-card"
                    >
                        <span class="step-number" aria-hidden="true">
                            {{ index + 1 }}
                        </span>

                        <div class="step-content">
                            <h3>Step {{ index + 1 }}</h3>
                            <p>{{ step }}</p>
                        </div>
                    </li>
                </ol>
            </section>

            <footer class="guide-footer">
                <p>Ready to explore another game?</p>

                <Link href="/games" class="browse-button">
                    Browse games →
                </Link>
            </footer>
        </div>
    </main>
</template>

<style scoped>
main {
    min-height: 100vh;
    padding: 48px 24px;
    background: #ffffff;
    color: #172033;
    font-family: Arial, sans-serif;
}

main *,
main *::before,
main *::after {
    box-sizing: border-box;
}

.page-container {
    max-width: 860px;
    margin: 0 auto;
}

.back-link {
    display: inline-block;
    color: #6d28d9;
    font-size: 14px;
    font-weight: 700;
    text-decoration: none;
}

.back-link:hover {
    text-decoration: underline;
}

.guide-header {
    margin-top: 32px;
    padding-bottom: 32px;
    border-bottom: 1px solid #e8eaf0;
}

.game-badge {
    display: inline-block;
    padding: 8px 12px;
    border-radius: 8px;
    background: #f1ecff;
    color: #6d28d9;
    font-size: 13px;
    font-weight: 700;
}

h1 {
    margin: 18px 0 0;
    color: #172033;
    font-size: clamp(30px, 5vw, 44px);
    font-weight: 800;
    line-height: 1.15;
    letter-spacing: -1.5px;
    overflow-wrap: anywhere;
}

.subtitle {
    margin: 16px 0 0;
    color: #647084;
    font-size: 16px;
    line-height: 1.6;
}

.step-count {
    margin: 18px 0 0;
    color: #647084;
    font-size: 13px;
    font-weight: 700;
}

.guide-content {
    padding-top: 32px;
}

.guide-content h2 {
    margin: 0 0 20px;
    color: #172033;
    font-size: 22px;
    font-weight: 700;
}

.steps-list {
    display: grid;
    gap: 16px;
    margin: 0;
    padding: 0;
    list-style: none;
}

.step-card {
    display: flex;
    align-items: flex-start;
    gap: 20px;
    padding: 24px;
    border: 1px solid #e1e4ed;
    border-radius: 14px;
    background: #ffffff;
    box-shadow: 0 4px 16px rgb(23 32 51 / 5%);
}

.step-number {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    min-width: 44px;
    height: 44px;
    padding: 0 8px;
    border-radius: 12px;
    background: #f1ecff;
    color: #6d28d9;
    font-size: 18px;
    font-weight: 800;
}

.step-content {
    min-width: 0;
}

.step-content h3 {
    margin: 0 0 8px;
    color: #172033;
    font-size: 15px;
    font-weight: 700;
}

.step-content p {
    margin: 0;
    color: #526075;
    font-size: 16px;
    line-height: 1.7;
    overflow-wrap: anywhere;
}

.guide-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    margin-top: 36px;
    padding-top: 28px;
    border-top: 1px solid #e8eaf0;
}

.guide-footer p {
    margin: 0;
    color: #647084;
    font-size: 14px;
}

.browse-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    padding: 13px 20px;
    border-radius: 10px;
    background: #6d28d9;
    color: #ffffff;
    font-size: 14px;
    font-weight: 700;
    text-decoration: none;
}

.browse-button:hover {
    background: #5b21b6;
}

.back-link:focus-visible,
.browse-button:focus-visible {
    outline: 3px solid #7c3aed;
    outline-offset: 4px;
}

@media (max-width: 600px) {
    main {
        padding: 28px 18px;
    }

    .step-card {
        gap: 14px;
        padding: 18px;
    }

    .guide-footer {
        flex-direction: column;
        align-items: flex-start;
    }
}
.empty-message {
    padding: 24px;
    border: 1px dashed #ddd6fe;
    border-radius: 14px;
    background: #f5f3ff;
    color: #647084;
    line-height: 1.7;
}
.add-guide-button {
    margin-top: 20px;
}

.guide-content + .guide-content {
    margin-top: 32px;
    border-top: 1px solid #e8eaf0;
}

.guide-heading {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 16px;
    margin-bottom: 20px;
}

.guide-heading h2 {
    margin: 0;
}

.edit-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 10px 16px;
    border: 1px solid #ddd6fe;
    border-radius: 8px;
    background: #f5f3ff;
    color: #6d28d9;
    font-size: 14px;
    font-weight: 700;
    text-decoration: none;
}

.edit-button:hover {
    background: #ede9fe;
}

.edit-button:focus-visible {
    outline: 3px solid #7c3aed;
    outline-offset: 4px;
}
</style>