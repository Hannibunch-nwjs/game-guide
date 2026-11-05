<script setup lang="ts">
import { computed, ref } from 'vue';
import { Link } from '@inertiajs/vue3';

defineOptions({
    layout: [],
});

const props = defineProps<{
    games: {
        id: number;
        title: string;
        genre: string;
    }[];
}>();

const search = ref('');

const filteredGames = computed(() => {
    const query = search.value.trim().toLowerCase();

    return props.games.filter((game) =>
        game.title.toLowerCase().includes(query)
    );
});
</script>

<template>
    <main>
        <div class="page-container">
            <header class="page-header">
                <div>
                    <p class="eyebrow">YOUR NEXT ADVENTURE STARTS HERE</p>
                    <h1>Game Guide Library</h1>
                    <p class="subtitle">
                        Find your game. Learn the basics. Start exploring.
                    </p>
                </div>

                <div class="header-actions">
    <Link
        v-if="$page.props.auth.user"
        href="/dashboard"
        class="dashboard-button"
    >
        ← Dashboard
    </Link>

    <Link href="/games/create" class="add-button">
        + Add Game
    </Link>
</div>
            </header>

            <section class="library" aria-label="Game library">
                <div class="toolbar">
                    <div class="search-group">
                        <label for="game-search">Find a game</label>

                        <input
                            id="game-search"
                            v-model="search"
                            type="search"
                            placeholder="Search by game name..."
                            class="search-input"
                        />
                    </div>

                    <p class="result-count" aria-live="polite">
                        {{ filteredGames.length }}
                        {{ filteredGames.length === 1 ? 'game' : 'games' }}
                    </p>
                </div>

                <div v-if="filteredGames.length === 0" class="empty-state">
                    <h2>No games found</h2>
                    <p>Try searching for a different game name.</p>
                </div>

                <div v-else class="game-grid">
                    <article
                        v-for="game in filteredGames"
                        :key="game.id"
                        class="game-card"
                    >
                        <div class="card-accent"></div>

                        <div class="card-content">
                            <span class="genre-badge">{{ game.genre }}</span>

                            <h2>{{ game.title }}</h2>

                            <Link
                                :href="`/games/${game.id}`"
                                class="guide-button"
                            >
                                View Guide <span aria-hidden="true">→</span>
                            </Link>
                        </div>
                    </article>
                </div>
            </section>
        </div>
    </main>
</template>

<style scoped>
main {
    min-height: 100vh;
    padding: 56px 24px;
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
    max-width: 1120px;
    margin: 0 auto;
}

.page-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 24px;
    padding-bottom: 36px;
    border-bottom: 1px solid #e8eaf0;
}

.eyebrow {
    margin: 0 0 12px;
    color: #6d28d9;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 1.6px;
}

h1 {
    margin: 0;
    color: #172033;
    font-size: clamp(30px, 5vw, 44px);
    font-weight: 800;
    line-height: 1.15;
    letter-spacing: -1.5px;
}

.subtitle {
    margin: 14px 0 0;
    color: #647084;
    font-size: 16px;
    line-height: 1.6;
}

.add-button {
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
    transition: background 0.2s;
}

.add-button:hover {
    background: #5b21b6;
}

.library {
    padding-top: 32px;
}

.toolbar {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 28px;
}

.search-group {
    width: 100%;
    max-width: 480px;
}

.search-group label {
    display: block;
    margin-bottom: 10px;
    color: #374151;
    font-size: 14px;
    font-weight: 700;
}

.search-input {
    display: block;
    width: 100%;
    padding: 14px 16px;
    border: 1px solid #d8dce5;
    border-radius: 10px;
    background: #f8f9fc;
    color: #172033;
    font: inherit;
    color-scheme: light;
}

.search-input::placeholder {
    color: #737e90;
}

.search-input:focus {
    border-color: #7c3aed;
    outline: 3px solid #ede9fe;
    outline-offset: 2px;
    background: #ffffff;
}

.result-count {
    flex-shrink: 0;
    margin: 0 0 15px;
    color: #647084;
    font-size: 14px;
}

.game-grid {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 24px;
}

.game-card {
    overflow: hidden;
    border: 1px solid #e1e4ed;
    border-radius: 16px;
    background: #ffffff;
    box-shadow: 0 5px 18px rgb(23 32 51 / 6%);
    transition:
        transform 0.2s,
        box-shadow 0.2s;
}

.game-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 28px rgb(23 32 51 / 12%);
}

.card-accent {
    height: 8px;
    background: #7c3aed;
}

.game-card:nth-child(3n + 2) .card-accent {
    background: #0d9488;
}

.game-card:nth-child(3n + 3) .card-accent {
    background: #d97706;
}

.card-content {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    height: calc(100% - 8px);
    padding: 26px;
}

.genre-badge {
    display: inline-block;
    padding: 6px 10px;
    border-radius: 6px;
    background: #f1ecff;
    color: #6d28d9;
    font-size: 12px;
    font-weight: 700;
}

.game-card h2 {
    margin: 18px 0 28px;
    color: #172033;
    font-size: 24px;
    font-weight: 700;
    line-height: 1.3;
    overflow-wrap: anywhere;
}

.guide-button {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    width: 100%;
    margin-top: auto;
    padding: 12px 14px;
    border: 1px solid #ddd6fe;
    border-radius: 8px;
    background: #f5f3ff;
    color: #6d28d9;
    font-size: 14px;
    font-weight: 700;
    text-decoration: none;
    transition: background 0.2s;
}

.guide-button:hover {
    background: #ede9fe;
}

.add-button:focus-visible,
.guide-button:focus-visible {
    outline: 3px solid #7c3aed;
    outline-offset: 4px;
}

.empty-state {
    padding: 56px 24px;
    border: 1px dashed #d8dce5;
    border-radius: 16px;
    background: #f8f9fc;
    text-align: center;
}

.empty-state h2 {
    margin: 0 0 10px;
    color: #172033;
    font-size: 22px;
    font-weight: 700;
}

.empty-state p {
    margin: 0;
    color: #647084;
}

@media (max-width: 900px) {
    .game-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
}

@media (max-width: 600px) {
    main {
        padding: 32px 18px;
    }

    .page-header {
        flex-direction: column;
        align-items: flex-start;
    }

    .toolbar {
        align-items: flex-start;
        flex-direction: column;
        gap: 12px;
    }

    .result-count {
        margin: 0;
    }

    .game-grid {
        grid-template-columns: 1fr;
    }
}

@media (prefers-reduced-motion: reduce) {
    .game-card,
    .add-button,
    .guide-button {
        transition: none;
    }

    .game-card:hover {
        transform: none;
    }
}
.header-actions {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 12px;
}

.dashboard-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 13px 20px;
    border: 1px solid #ddd6fe;
    border-radius: 10px;
    background: #f5f3ff;
    color: #6d28d9;
    font-size: 14px;
    font-weight: 700;
    text-decoration: none;
}

.dashboard-button:hover {
    background: #ede9fe;
}

.dashboard-button:focus-visible {
    outline: 3px solid #7c3aed;
    outline-offset: 4px;
}
</style>