<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://appcenter.intuit.com/Content/IA/intuit.ipp.anywhere.js"></script>
        <script>
            intuit.ipp.anywhere.setup({
                grantUrl: 'http://ec2-54-208-97-74.compute-1.amazonaws.com/qb_token_request',
                menuProxy: '',
                datasources: {
                    quickbooks : true,
                    payments : true
                }
            });
        </script>
    </head>
    <body>
        <ipp:connectToIntuit></ipp:connectToIntuit>
    </body>
</html>
