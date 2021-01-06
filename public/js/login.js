$("#login").validate({
    rules: {
        'user[name]': {
            required: true,
        },
        'user[email]': {
            required: true,
            email: true,
        },
        'user[password]': {
            required: true,
        }
    },
    messages: {
        'user[name]': {
            required: "required",
        },
        'user[email]': {
            required: "required",
            email: "not an email"
        },
        'user[password]': {
            required: "required",
        }
    }
});
