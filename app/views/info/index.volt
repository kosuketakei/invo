<h1>Users of Invo are only authorized to access to sepecial pages...</h1>

{{ form("info/logined", "autocomplete": "off") }}

<div>
    <h2>Info Page</h2>

    <div class="clearfix">
        <label for="id">Username</label>
        {{ text_field("username", "size": 10, "maxlength": 20) }}
    </div>

    <div class="clearfix">
        <label for="name">Password</label>
        {{ text_field("password", "size": 24, "maxlength": 70) }}
    </div>

    <div class="clearfix">
        {{ submit_button("Submmit", "class": "btn btn-primary") }}
    </div>

</div>
</form>