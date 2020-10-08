<h1>Only users of Invo are authorized to access to setting pages...</h1>

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
        {{ submit_button("Login", "class": "btn btn-primary") }}
    </div>

</div>
</form>