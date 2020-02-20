@extends('layouts.admin')

@section('header-content')

@endsection
@section('content')

        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">Income Tax Scale</h5>
            </div>

              <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-framed table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Citizen Type</th>
                            <th>Income</th>
                            <th>Tax</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td>Business Man</td>
                            <td>Greater than 4 Lakh</td>
                            <td> 20% of income</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Job Holder</td>
                            <td>Greater than 2 Lakh</td>
                            <td> 15% of income</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Labour</td>
                            <td>Greater than 1 Lakh</td>
                            <td> 10% of income</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel-heading">
                <h5 class="panel-title">Property Tax Scale</h5>
            </div>
            <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-bordered table-framed table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Area</th>
                        <th>Type</th>
                        <th>Marla</th>
                        <th>Tax Formula</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>1</td>
                        <td>Residential</td>
                        <td>any</td>
                        <td>less than 10</td>
                        <td> (Baisc Unit * Baisc Unit) + Department tax + Income tax </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Residential</td>
                        <td>rent</td>
                        <td>10 to 20</td>
                        <td> (Baisc Unit * 200) + Department tax + Income tax</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Residential</td>
                        <td>self</td>
                        <td>10 to 20</td>
                        <td> ( Baisc Unit * 100 ) + Department tax + Income tax</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Residential</td>
                        <td>rent</td>
                        <td>greater than 20</td>
                        <td> (Baisc Unit * 500)+ Department tax + Income tax</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Residential</td>
                        <td>self</td>
                        <td>greater than 20</td>
                        <td> ( Baisc Unit * 400 )+ Department tax + Income tax</td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Commercial</td>
                        <td>any</td>
                        <td>less than 10</td>
                        <td> [( Baisc Unit * Baisc Unit ) * 2 ]+ Department tax + Income tax </td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>Commercial</td>
                        <td>rent</td>
                        <td>10 to 20</td>
                        <td>[( Baisc Unit * 200 ) * 2 ]+ Department tax + Income tax </td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td>Commercial</td>
                        <td>self</td>
                        <td>10 to 20</td>
                        <td>[ ( Baisc Unit * 100 ) * 2 ]+ Department tax + Income tax </td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td>Commercial</td>
                        <td>rent</td>
                        <td>greater than 20</td>
                        <td>[ ( Baisc Unit * 500 ) * 2 ]+ Department tax + Income tax</td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td>Commercial</td>
                        <td>self</td>
                        <td>greater than 20</td>
                        <td>[( Baisc Unit * 400 ) * 2 ]+ Department tax + Income tax </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <br>
            </div>

        </div>
        <!-- /bordered panel body table -->
@endsection

@section('footer-content')
<script>
    function deleteItem(url) {
        if ($('#deleteForm').length > 0) {
            if (confirm('Are you sure you want to delete this?')) {
                $('#deleteForm').attr('action', url);
                $('#deleteForm').submit();
            }
        }
    }
</script>
@endsection
