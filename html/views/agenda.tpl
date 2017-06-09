<section class="hero is-primary">
    <div class="hero-body">
        <div class="container">
            <h1 class="title">
                JA Community
            </h1>
            <h2 class="subtitle">
                Java and Android coding help
            </h2>
        </div>
    </div>
</section>
<div class="">
    <div class="columns">
        <div class="column">
            <div class="column">
                {foreach from=$result_list item=agenda}
                    <section class="hero {$agenda.color}">
                        <div class="hero-body">
                            <div class="container">
                                <h1 class="title">
                                    {$agenda.title}
                                </h1>
                                <h2 class="subtitle">
                                    {$agenda.description}
                                </h2>
                                <footer>
                                    van {$agenda.start_d} om {$agenda.start_t} tot {$agenda.end_d} om {$agenda.end_t}
                                </footer>
                            </div>
                        </div>
                    </section>
                {/foreach}
            </div>
        </div>
    </div>
</div>
</body>