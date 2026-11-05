<script setup lang="ts">
import { Link, useForm } from '@inertiajs/vue3';


defineOptions({
    layout: [],
});

const form = useForm<{
    title: string;
    genre: string;
    image: File|null;
}>({
    title: '',
    genre: '',
    image: null,
});
function selectImage(event: Event){
    const input =event.target as HTMLInputElement;

    form.image =input.files?.[0] ?? null;
}

function submit() {
    form.post('/games');
}
</script>

<template>
    <main>
        <Link href="/games" class="back">
            ← Back to games
        </Link>

        <h1>Add Game</h1>
        <p class="page-description">
            Expand your library. add a game,then start writing it's guides.
        </p>

        <form @submit.prevent="submit">
            <label for="title">Game title</label>

            <input
                id="title"
                v-model="form.title"
                type="text"
                placeholder="Example: Hollow Knight"
            />

            <p v-if="form.errors.title" class="error">
                {{ form.errors.title }}
            </p>

            <label for="genre">Genre</label>

            <input
                id="genre"
                v-model="form.genre"
                type="text"
                placeholder="Example: Adventure"
            />

            <p v-if="form.errors.genre" class="error">
                {{ form.errors.genre }}
            </p>

            <label for="image">Game Image</label>
            <input
            id="image"
            type="file"
            accept="image/jpeg,image/png,image/webp"
            @change="selectImage"
            />

            <p class="upload hint">
                Optional. Choose a JPG, PNG, or WebP image up to 2 MB
            </p>
            <p v-if="form.errors.image" class="error">
                {{ form.errors.image }}
            </p>

            <button type="submit" :disabled="form.processing">
                {{ form.processing ? 'saving...': 'Save Game' }}
            </button>



            
        </form>
    </main>
</template>

<style scoped>
main {
   box-sizing: border-box;
   min-height: 100vh;
   display: flex;
   flex-direction: column;
   justify-content: center;
   padding: 48px 24px;
   background: linear-gradient(135deg, #ffffff 0%, #ede9fe 40%, #c4b5fd 75%, #a78bfa 100%);
   color: #1f2937;
   font-family: arial, sans-serif;


}

.back {
    width: 100%;
    margin-left: 40px;
    margin-top: 40px;
    display: inline-block;
    color: #4f46e5;
    font-weight: 600;
    text-decoration: none;
    display: block;
    max-width: 560px;
    margin:0 auto;
}

.back:hover {
    text-decoration: underline;
}

h1 {
    letter-spacing: 10px;
    font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif ;
    margin: 24px 0;
    font-size: 56px;
    font-weight: bold;
    margin:32px 0 12px;
    color: #111827;
    text-align: center;
}

form {
    width: 100%;
    max-width: 560px;
    padding: 28px;
    border: 1px solid #e5e7eb;
    border-radius: 16px;
    background: #f9fafb;
    margin: 0 auto;
    box-shadow: 0 4px 16px rgb(0 0 0 / 4%);
}

label {
    display: block;
    margin-top: 20px;
    margin-bottom: 8px;
    color: #374151;
    font-weight: 600;
}

label:first-child {
    margin-top: 0;
}

input {
    box-sizing: border-box;
    width: 100%;
    padding: 12px 16px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    background: #ffffff;
    color: #111827;
    font-size: 16px;
}

input::placeholder {
    color: #9ca3af;
}

input:focus {
    border-color: #4f46e5;
    outline: 2px solid #c7d2fe;
    outline-offset: 2px;
}

.error {
    margin-top: 8px;
    color: #dc2626;
    font-size: 14px;
}

button {
    margin-top: 24px;
    padding: 12px 20px;
    border: none;
    border-radius: 8px;
    background: #4f46e5;
    color: #ffffff;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s;
}

button:hover:not(:disabled) {
    background: #4338ca;
}

button:focus-visible {
    outline: 2px solid #4f46e5;
    outline-offset: 3px;
}

button:disabled {
    opacity: 0.6;
    cursor: wait;
}

@media (max-width: 600px) {
    main {
        padding: 24px 16px;
    }

    form {
        padding: 20px;
    }

    h1 {
        font-size: 28px;
    }
}

.page-description {
    max-width: 560px;
    margin: 0 auto 28px;
    color: #6b7280;
    font-size: 16px;
    line-height: 1.6;
    text-align: center;
}
input[type=file]{
    padding: 10px;
    background: #ffffff;
    cursor: pointer;
}

input[type=file]::file-selector-button {
    margin-right: 14px;
    padding: 10px 16px;
    border: none;
    border-radius: 8px;
    background: #4f46e5;
    color: #ffffff;
    font-weight: 600;
    cursor: pointer;

}

input[type="file"]::file-selector-button:hover{
    background: #4338ca;
}
</style>