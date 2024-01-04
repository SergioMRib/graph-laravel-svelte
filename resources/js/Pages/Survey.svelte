<script>
  import { inertia, page } from '@inertiajs/inertia-svelte'

  export let questions = []

  //$title = 'Questions'

</script>

<h1 class="mb-8 font-bold text-3xl">Survey</h1>

<div class="bg-white rounded-md shadow overflow-x-auto">

    {#each questions as question (question.id)}
        <p class="mx-4">{ question.title}</p>
    {/each}

    {#if questions.length === 0}
        <p class="border-t px-6 py-4" colspan="4">No questions found.</p>
    {/if}
</div>
