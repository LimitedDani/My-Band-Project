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
                            <h1 class="title">Articles</h1>
                        </p>
                        {if !$result_list}<h1 class="subtitle">No articles found</h1>{/if}
                        {foreach from=$result_list item=articles}
                            <a href="/myband/article&id={$articles.ID}">
                                <hr />
                                <h1 class="title is-1">{$articles.title}</h1>
                                <span>{$articles.article|strip_tags|strip|truncate:100}</span>
                            </a>
                        {/foreach}
                        <hr />
                        <br />
                            {if $pageid == 0}
                                <nav class="pagination">
                                    <a class="pagination-next" href="home?p={$pageid+1}">Next page</a>
                                    <ul class="pagination-list">
                                        <li>
                                            <a class="pagination-link is-current">1</a>
                                        </li>
                                        {if $isnext}
                                            <li>
                                                <a class="pagination-link" href="home?p={$pageid+1}">2</a>
                                            </li>
                                        {/if}
                                    </ul>
                                </nav>
                            {else}
                                <nav class="pagination">
                                    <a class="pagination-previous" href="home?p={$pageid-1}">Previous</a>
                                    {if $isnext}
                                        <a class="pagination-next" href="home?p={$pageid+1}">Next page</a>
                                    {/if}
                                    <ul class="pagination-list">
                                        <li>
                                            <a class="pagination-link" href="home?p={$pageid-1}">{$pageid}</a>
                                        </li>
                                        <li>
                                            <a class="pagination-link is-current">{$pageid+1}</a>
                                        </li>
                                        {if $isnext}
                                            <li>
                                                <a class="pagination-link" href="home?p={$pageid+1}">{$pageid+2}</a>
                                            </li>
                                        {/if}
                                    </ul>
                                </nav>
                            {/if}
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