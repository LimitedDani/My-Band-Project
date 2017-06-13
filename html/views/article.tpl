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
                <hr />
                <h1 class="title is-1">{$title}</h1>
                <span>{$article}</span>
                <hr />
                <form target="" method="post">
                    <div class="field">
                        <label class="label">Name</label>
                        <p class="control">
                            <input class="input" type="text" placeholder="Text input" id="comment_name" name="comment_name">
                        </p>
                    </div>
                    <div class="field">
                        <label class="label">Message</label>
                        <p class="control">
                            <textarea class="textarea" placeholder="Textarea" id="comment_message" name="comment_message"></textarea>
                        </p>
                    </div>
                    <div class="field">
                        <label class="label">Recaptcha</label>
                        <p class="control">
                            <div class="g-recaptcha" data-sitekey="6Lcmth0UAAAAAHnDmpanMym-TT1sDikDMcicyGQk"></div>
                        </p>
                    </div>
                    <input type="hidden" name="comment_id" id="comment_id" value="{$id}">
                    <div class="field is-grouped">
                        <p class="control">
                            <button class="button is-primary" name="comment_post" id="comment_post">Submit</button>
                        </p>
                    </div>
                </form>
                <hr />
                {foreach from=$comments item=comment}
                    <div class="box">
                        <article class="media">
                            <div class="media-left">
                                <figure class="image is-64x64">
                                    <img src="http://bulma.io/images/placeholders/128x128.png" alt="Image">
                                </figure>
                            </div>
                            <div class="media-content">
                                <div class="content">
                                    <p>
                                        <strong>{$comment.user}</strong>
                                        <br>
                                        {$comment.comment}
                                    </p>
                                </div>
                            </div>
                        </article>
                    </div>
                {/foreach}
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
<script src='https://www.google.com/recaptcha/api.js'></script>

</body>