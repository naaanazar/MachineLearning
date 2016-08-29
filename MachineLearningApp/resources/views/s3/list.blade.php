@extends('header')

@extends('list')
    <div class="container">
        <div class="row">
            <table class="table text-center table-font">
                <tr class="active">
                    <td>Target</td>
                    <td>Email custom domain</td>
                    <td>Same email domain count</td>
                    <td>Projects count</td>
                    <td>Strings count</td>
                    <td>Members count</td>
                    <td>Has private project</td>
                    <td>Same login and project name</td>
                    <td>Days after last login</td>
                    <td>Country</td>
                    <td>Purchase</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>0</td>
                    <td>989</td>
                    <td>52</td>
                    <td>15</td>
                    <td>453</td>
                    <td>0</td>
                    <td>0</td>
                    <td>13</td>
                    <td>Saudi Arabia</td>
                    <td>0</td>
                    <td>
                        <a class="btn btn-default btn-sm" href=""><span class="glyphicon glyphicon-edit"></span></a>
                        <a class="btn btn-danger btn-sm" href=""><span class="glyphicon glyphicon-trash"></span></a>
                    </td>
                </tr>
             </table>
         </div>
     </div>
@extends('footer')