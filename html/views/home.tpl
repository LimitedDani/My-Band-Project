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
<div class="container">
    <div class="columns">
        <div class="column is-three-quarters">
            <div class="column">
                <div class="card">
                    <div class="card-content">
                        <p class="title">
                            <h1 class="title">Newest articles</h1>
                        </p>
                        {foreach from=$result_list item=about}
                            <h1>{$about.text}</h1>
                        {/foreach}
                    </div>
                </div>
            </div>
        </div>
        <div class="column">
            <div class="card">
                <div class="card-content">
                    <p class="title">
                        “There are two hard things in computer science: cache invalidation, naming things, and off-by-one errors.”
                    </p>
                    <p class="subtitle">
                        Jeff Atwood
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>