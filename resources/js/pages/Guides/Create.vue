<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';

defineOptions({
    layout: [],
});

const props = defineProps<{
    game: {
        id: number;
        title: string;
    };
}>();

const form = useForm({
    title: '',
    steps: [''],
});

function addStep() {
    form.steps.push('');
}

function removeStep(index: number) {
    form.steps.splice(index, 1);
    form.clearErrors();
}

function submit() {
    form.post(`/games/${props.game.id}/guides`);
}
</script>

<template>
    <Head :title="`Add Guide for ${game.title}`" />

    <main>
        <div class="page-container">
            <Link :href="`/games/${game.id}`" class="back-link">
                ← Back to game
            </Link>

            <header>
                <span class="game-badge">{{ game.title }}</span>
                <h1>Write a guide</h1>
                <p>Give your guide a title, then explain each step.</p>
            </header>

            <form @submit.prevent="submit">
                <div class="title-field">
                    <label for="guide-title">Guide title</label>

                    <input
                        id="guide-title"
                        v-model="form.title"
                        type="text"
                        placeholder="Example: Your First Day"
                    />

                    <p v-if="form.errors.title" class="error">
                        {{ form.errors.title }}
                    </p>
                </div>

                <h2>Walkthrough steps</h2>

                <p v-if="form.errors.steps" class="error">
                    {{ form.errors.steps }}
                </p>

                <div
                    v-for="(step, index) in form.steps"
                    :key="index"
                    class="step-field"
                >
                    <div class="step-heading">
                        <label :for="`step-${index}`">
                            Step {{ index + 1 }}
                        </label>

                        <button
                            v-if="form.steps.length > 1"
                            type="button"
                            class="remove-button"
                            :aria-label="`Remove step ${index + 1}`"
                            :disabled="form.processing"
                            @click="removeStep(index)"
                        >
                            Remove
                        </button>
                    </div>

                    <textarea
                        :id="`step-${index}`"
                        v-model="form.steps[index]"
                        rows="3"
                        placeholder="Explain what the player should do..."
                    ></textarea>

                    <p
                        v-if="form.errors[`steps.${index}`]"
                        class="error"
                    >
                        {{ form.errors[`steps.${index}`] }}
                    </p>
                </div>

                <button
                    type="button"
                    class="secondary-button"
                    :disabled="form.processing"
                    @click="addStep"
                >
                    + Add another step
                </button>

                <div class="form-actions">
                    <Link
                        :href="`/games/${game.id}`"
                        class="cancel-link"
                    >
                        Cancel
                    </Link>

                    <button
                        type="submit"
                        class="primary-button"
                        :disabled="form.processing"
                    >
                        {{ form.processing ? 'Saving...' : 'Save Guide' }}
                    </button>
                </div>
            </form>
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

main * {
    box-sizing: border-box;
}

.page-container {
    max-width: 760px;
    margin: 0 auto;
}

.back-link,
.cancel-link {
    color: #6d28d9;
    font-size: 14px;
    font-weight: 700;
    text-decoration: none;
}

.back-link:hover,
.cancel-link:hover {
    text-decoration: underline;
}

header {
    margin: 32px 0;
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
    margin: 18px 0 12px;
    font-size: clamp(30px, 5vw, 40px);
    font-weight: 800;
    line-height: 1.2;
}

header p {
    margin: 0;
    color: #647084;
    line-height: 1.7;
}

form {
    padding: 28px;
    border: 1px solid #e1e4ed;
    border-radius: 16px;
    background: #ffffff;
    box-shadow: 0 5px 18px rgb(23 32 51 / 5%);
}

label {
    display: block;
    color: #374151;
    font-size: 14px;
    font-weight: 700;
}

.title-field label {
    margin-bottom: 10px;
}

input,
textarea {
    display: block;
    width: 100%;
    padding: 13px 14px;
    border: 1px solid #d8dce5;
    border-radius: 10px;
    background: #f8f9fc;
    color: #172033;
    font: inherit;
    line-height: 1.6;
    color-scheme: light;
}

textarea {
    resize: vertical;
}

input:focus,
textarea:focus {
    border-color: #7c3aed;
    outline: 3px solid #ede9fe;
    outline-offset: 2px;
}

h2 {
    margin: 32px 0 18px;
    font-size: 20px;
    font-weight: 700;
}

.step-field {
    margin-bottom: 20px;
}

.step-heading {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    margin-bottom: 10px;
}

.remove-button {
    padding: 4px;
    border: none;
    background: transparent;
    color: #b91c1c;
    font-size: 13px;
    cursor: pointer;
}

.error {
    margin: 8px 0 0;
    color: #b91c1c;
    font-size: 13px;
}

.primary-button,
.secondary-button {
    padding: 12px 18px;
    border: 1px solid transparent;
    border-radius: 10px;
    font-size: 14px;
    font-weight: 700;
    cursor: pointer;
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
    background: #f5f3ff;
    color: #6d28d9;
}

.secondary-button:hover {
    background: #ede9fe;
}

.form-actions {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 20px;
    margin-top: 32px;
    padding-top: 24px;
    border-top: 1px solid #e8eaf0;
}

button:disabled {
    opacity: 0.6;
    cursor: wait;
}

button:focus-visible,
a:focus-visible {
    outline: 3px solid #7c3aed;
    outline-offset: 4px;
}

@media (max-width: 600px) {
    main {
        padding: 28px 18px;
    }

    form {
        padding: 20px;
    }
}
</style>