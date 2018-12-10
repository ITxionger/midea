@extends('Admin.Public.public')
@section('title','管理员列表')
@section('admin')
<div class="mws-panel grid_8">
                    <div class="mws-panel-header">
                         <span><i class="icon-table"></i> Simple Table</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                        <table class="mws-table">
                            <thead>
                                <tr>
                                    <th>Rendering engine</th>
                                    <th>Browser</th>
                                    <th>Platform(s)</th>
                                    <th>Engine version</th>
                                    <th>CSS grade</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Trident</td>
                                    <td>Internet
                                         Explorer 4.0</td>
                                    <td>Win 95+</td>
                                    <td>4</td>
                                    <td>X</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
@endsection
 