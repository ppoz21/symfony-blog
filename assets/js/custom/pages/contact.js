const contact = () => {

    function validateNotBlanc(value)
    {
        return value.trim() !== '';
    }

    function validatePhone(value)
    {
        const re = /^[0-9]{9}$/;
        return re.test(String(value).toLowerCase())
    }

    function validateEmail(email) {
        const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }

    $(document).on('focusout change', '*[data-validate="notblanc"]', function() {
        let input = $(this);
        let val = input.val();
        if (!validateNotBlanc(val))
        {
            input.removeClass('success');
            input.addClass('error');
        }
        else
        {
            input.removeClass('error');
            input.addClass('success');
        }
    });

    $(document).on('focusout change', '*[data-validate="email"]', function() {
        let input = $(this);
        let val = input.val();
        if (!validateEmail(val))
        {
            input.removeClass('success');
            input.addClass('error');
        }
        else
        {
            input.removeClass('error');
            input.addClass('success');
        }
    });

    $(document).on('focusout change', '*[data-validate="phone"]', function() {
        let input = $(this);
        let val = input.val();
        if (!validatePhone(val))
        {
            input.removeClass('success');
            input.addClass('error');
        }
        else
        {
            input.removeClass('error');
            input.addClass('success');
        }
    });
}

window.initContact = () => {
    contact();
}
