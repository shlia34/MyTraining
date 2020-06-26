export const alertError = {
    methods: {
        alertError(response) {
            var errors = response.data.errors;

            $.each(errors, function(index, value) {
                alert(value);
            });
        },
    }
};
