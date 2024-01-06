<script>
  import { inertia, page } from '@inertiajs/inertia-svelte'

  export let questions = []

  let values = [1,2,3,4,5,6,7,8]
  //$title = 'Questions'

  $: prequery = questions.reduce((text, item) => {
                return text + item.title + '=' + item.choice + '&'
            }, '')

  $: query = prequery.substring(0, prequery.length - 1)


    function navigateToPage(e) {
        e.preventDefault();
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

    .form {
        margin: 4em;
    }

*, *:after, *:before {
	 box-sizing: border-box;
}
 body {
	 font-family: "Inter", sans-serif;
	 color: #000021;
	 font-size: calc(1em + 1.25vw);
	 background-color: #e6e6ef;
}
 form {
	 display: flex;
	 flex-wrap: wrap;
	 flex-direction: column;
}
 label {
	 display: flex;
	 cursor: pointer;
	 font-weight: 500;
	 position: relative;
	 overflow: hidden;
	 margin-bottom: 0.375em;
	/* Accessible outline */
	/* Remove comment to use */
	/* &:focus-within {
		 outline: .125em solid $primary-color;
	}
	 */
}
 label input {
	 position: absolute;
	 left: -9999px;
}
 label input:checked + span {
	 background-color: #d6d6e5;
}
 label input:checked + span:before {
	 box-shadow: inset 0 0 0 0.4375em #00005c;
}
 label span {
	 display: flex;
	 align-items: center;
	 padding: 0.375em 0.75em 0.375em 0.375em;
	 border-radius: 99em;
	 transition: 0.25s ease;
}
 label span:hover {
	 background-color: #d6d6e5;
}
 label span:before {
	 display: flex;
	 flex-shrink: 0;
	 content: "";
	 background-color: #fff;
	 width: 1.5em;
	 height: 1.5em;
	 border-radius: 50%;
	 margin-right: 0.375em;
	 transition: 0.25s ease;
	 box-shadow: inset 0 0 0 0.125em #00005c;
}

.flex {
    display: flex;
    justify-content: center;
}

.question {
    background-color: white;
        transition: background-color 0.3s ease-in-out; /* Transition duration and timing function */
}

.question:hover {
    background-color: #f0f0f0;
}

</style>
<h1 class="text-center text-3xl font-bold text-amber-600 rounded-md my-4">Survey</h1>

<div class="rounded-md overflow-x-auto">

    <form class="text-center form">
        {#each questions as question (question.id)}
            <div class="question">
                { question.title}
                <div class="flex">
                    {#each values as value}
                        <label>
                            <input type="radio" id={ question.title + '_choice_' + value} bind:group={ question.choice} name={ question.title + '_choice'} value={value} />
                            <span>{ value}</span>
                        </label>
                    {/each}
                </div>
            </div>
        {/each}

        {#if questions.length === 0}
            <p class="border-t px-6 py-4" colspan="4">No questions found.</p>
        {/if}

        <button on:click={navigateToPage} class="btn">
            Open chart
        </button>
    </form>
    {#if false}

        {#each questions as question (question.id)}
            <p class="mx-4">
                { question.title} - { question.choice}
           </p>
        {/each}
    {/if}

</div>
