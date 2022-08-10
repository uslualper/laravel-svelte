<div class="w-[100vw] h-[20vh] left-1/2 bg-gradient-to-b from-yellow-500 to-orange-600 shadow-2xl flex flex-col justify-center items-center">
    <h1 class="text-7xl font-bold text-white tracking-widest">Laravel Svelte</h1>
    <p class="mt-6 text-slate-100 text-xl">Alper Uslu</p>
</div>

<div class="grid grid-flow-row-dense grid-cols-3 grid-rows-3 p-10">
    <div class="col-span-2">
        <div >
        <h2 class="font-medium leading-tight text-4xl mt-0 mb-2 text-blue-600 ">Haftalık Plan</h2>
        {#if plans}
            <h3>Toplam {plans.weeks.length} Hafta</h3>
            <div class="grid grid-flow-row-dense grid-cols-2">
            {#each plans.weeks as week,i}
                <div class="p-6 max-w-xl bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                    <a href="#">
                        <small>Kapasite : {week.cost}</small>
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"> {i+1}. Hafta</h5>                        
                    </a>
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="py-3 px-6">
                                    Developer
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    İşler
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        {#if typeof week.developers === 'object' && week.developers.length > 0}
                        {#each week.developers as item,i}
                            <tr>
                                <th scope="col" class="py-3 px-6">
                                    <span class="text-blue-600">{item.developer.name}</span> <br> 
                                    <small>Kullanılan : <br>
                                        Kapasite : {item.tasks.map(x=>x.cost).reduce((a,b) => a+b,0)} <br>
                                        Saat : {(item.tasks.map(x=>x.cost).reduce((a,b) => a+b,0) / item.developer.level).toFixed(1)}
                                    </small> 
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    {#each item.tasks as { code }, k}
                                    <span class="px-4 py-2 rounded-full text-gray-500 bg-gray-200 font-semibold text-sm flex align-center w-max cursor-pointer active:bg-gray-300 transition duration-300 ease">
                                        {code} 
                                    </span>
                                    {/each}
                                </th>
                            </tr>
                        {/each} 
                        {/if}      
                        </tbody>
                    </table>
                </div>
            {/each}
            </div>
        {/if}
        </div>
    </div>

    <div class="float-right">
        <h2 class="font-medium leading-tight text-4xl mt-0 mb-2 text-blue-600">Geliştiriciler</h2>
        {#if developers}
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="py-3 px-6">
                        Developer
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Süre
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Zorluk
                    </th>
                </tr>
            </thead>
            <tbody>
                {#each developers as { name, level }, i}
                <tr>
                    <th scope="col" class="py-3 px-6">
                        {name}
                    </th>
                    <th scope="col" class="py-3 px-6">
                        1 Saat
                    </th>
                    <th scope="col" class="py-3 px-6">
                        {level}
                    </th>
                </tr>
            {/each}
            </tbody>
        </table>
        {/if}
        <hr>
        <h2 class="font-medium leading-tight text-4xl mt-0 mb-2 text-blue-600">İşler</h2>
        {#if tasks}
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="py-3 px-6">
                        Kod
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Süre
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Zorluk
                    </th>
                </tr>
            </thead>
            <tbody>
            {#each tasks as { code, level, duration }, i}
                <tr>
                    <th scope="col" class="py-3 px-6">
                        {code}
                    </th>
                    <th scope="col" class="py-3 px-6">
                        {duration}
                    </th>
                    <th scope="col" class="py-3 px-6">
                        {level}
                    </th>
                </tr>
            {/each}
            </tbody>
        </table>
        {/if}
    </div>
    
</div>

<script>

    const apiURL = "/api/";

    const getData = async (path) => {
        const res = await fetch(apiURL+path)
        if (!res.ok) throw new Error('Bad response')
        const items = await res.json()
        return items
    }

    $: tasks = false;
    getData('tasks').then(
        data => {
            tasks = data;
        }
    );
    $: developers = false;
    getData('developers').then(
        data => {
            developers = data;
        }
    );

    $: plans = false;
    getData('tasks/calculate').then(
        data => {
            console.log(data);
            plans = data;
        }
    );
</script>