<script>
  import { inertia, page } from '@inertiajs/inertia-svelte'

  export let questions = []

  let values = [1,2,3,4,5,6,7,8]
  //$title = 'Questions'

  $: prequery = questions.reduce((text, item) => {
                return text + item.title + '=' + item.choice + '&'
            }, '')

  $: query = prequery.substring(0, prequery.length - 1)


    function navigateToPage() {
        // Navigate to a new page or update the URL using JavaScript
        window.location.href = '/chart?' + query;
    }

</script>

<style>
    .btn {
  display: inline-block;
  padding: 8px 16px;
  border-radius: 5px;
  background-color: orange;
  color: white;
  text-decoration: none;
  transition: background-color 0.3s ease;
}

.btn:hover {
  background-color: darkorange;
}

</style>
<h1 class="mb-8 font-bold text-3xl">Survey</h1>

<div class="bg-white rounded-md shadow overflow-x-auto">
    <p class="mx-3">Query: { query}</p>
    {#each questions as question (question.id)}
        <p class="mx-4">
            { question.title} <br>
            {#each values as value}
                <span class="mx-2 inline">
                    <input type="radio" id={ question.title + '_choice_' + value} bind:group={ question.choice} name={ question.title + '_choice'} value={value} />
                    <label for={ question.title + '_choice'}>{value}</label>
                </span>
            {/each}
        </p>
    {/each}

    {#if questions.length === 0}
        <p class="border-t px-6 py-4" colspan="4">No questions found.</p>
    {/if}

    <button on:click={navigateToPage} class="btn">
        Open chart
    </button>

    {#if false}

        {#each questions as question (question.id)}
            <p class="mx-4">
                { question.title} - { question.choice}
           </p>
        {/each}
    {/if}

</div>
