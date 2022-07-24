@extends('layout.default')

@section('title')
    <title>Moderation - {{ __('staff.staff-dashboard') }} - {{ config('other.title') }}</title>
@endsection

@section('breadcrumbs')
    <li class="breadcrumbV2">
        <a href="{{ route('staff.dashboard.index') }}" class="breadcrumb__link">
            {{ __('staff.staff-dashboard') }}
        </a>
    </li>
    <li class="breadcrumb--active">
        {{ __('staff.torrent-moderation') }}
    </li>
@endsection

@section('content')
    <div>
        <div class="panelV2" x-data="{ tab: 0, reviewTorrent: false, moderateTorrent: false }">
            <div class="panel__heading">
                <div class="form__group--horizontal">
                    <p class="form__group" style="padding-inline: 10%">
                        <button class="form__button"
                                :class="{'form__button--outlined': tab !== 0, 'form__button--filled': tab === 0 }"
                                @click="tab = 0; reviewTorrent = false;"
                                style="width: 100%;">
                            All ({{$pending->count() + $postponed->count() + $rejected->count() }})
                        </button>
                    </p>
                    <p class="form__group" style="padding-inline: 10%">
                        <button class="form__button"
                                :class="{'form__button--outlined': tab !== 1, 'form__button--filled': tab === 1 }"
                                @click="tab = 1; reviewTorrent = false;"
                                style="width: 100%;">
                            Pending ({{$pending->count()}})
                        </button>
                    </p>
                    <p class="form__group" style="padding-inline: 10%">
                        <button class="form__button"
                                :class="{'form__button--outlined': tab !== 2, 'form__button--filled': tab === 2 }"
                                @click="tab = 2; reviewTorrent = false;"
                                style="width: 100%;">
                            Postponed ({{$postponed->count()}})
                        </button>
                    </p>
                    <p class="form__group" style="padding-inline: 10%">
                        <button class="form__button"
                                :class="{'form__button--outlined': tab !== 3, 'form__button--filled': tab === 3 }"
                                @click="tab = 3; reviewTorrent = false;"
                                style="width: 100%;">
                            Rejected ({{$rejected->count()}})
                        </button>
                    </p>
                </div>
            </div>
            <div class="panel__body">
                <template x-if="( tab === 1 || tab === 0 )">
                    <div class="block" style="margin: 0 !important;
                        padding-bottom: 10px !important;
                        border-radius: 0 !important;
                        border: none !important;
                        box-shadow: none !important;">
                        <div><p style="font-size: 22px; margin-top: 10px; margin-bottom: 6px;">Pending Torrents</p>
                        </div>
                        <hr style="margin-top: 10px !important; margin-bottom: 12px !important;"/>
                        <div class="table-responsive">
                            <table class="table table-condensed table-striped table-bordered"
                                   style="margin-bottom: 0 !important;">
                                <thead>
                                <tr>
                                    <th>Uploaded</th>
                                    <th class="torrents-filename">Torrent Name</th>
                                    <th>Category</th>
                                    <th>Type</th>
                                    <th>Resolution</th>
                                    <th>Size</th>
                                    <th>Uploader</th>
                                    <th>Moderation</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($pending as $p)
                                    <tr>
                                        <td style="font-size: 1.2rem">{{$p->created_at->diffForHumans()}}</td>
                                        <td class="torrents-filename"><a target="_blank"
                                                                         href="{{route('torrent', ['id'=> $p->id])}}">{{$p->name}}
                                                <i style="font-size: 1rem" class="fas fa-external-link"></i></a></td>
                                        <td>{{$p->category->name}} </td>
                                        <td>{{$p->type->name}}</td>
                                        <td>{{$p->resolution->name}}</td>
                                        <td>{{$p->getSize()}}</td>
                                        <td>{{$p->user->username}}</td>
                                        <td>
                                            <button class="btn btn-labeled btn-info btn-xs"
                                                    @click="reviewTorrent = '{{ route('torrent', ['id' => $p->id]) }}?iframe=1'; tab = 4;">
                                                <i class="fas fa-file-search"></i> Review
                                            </button>
                                            <form role="form" method="POST"
                                                  action="{{ route('staff.moderation.approve', ['id' => $p->id]) }}"
                                                  style="display: inline-block;">
                                                @csrf
                                                <button type="submit"
                                                        class="btn btn-labeled btn-xs btn-success">
                                                    <i class="{{ config('other.font-awesome') }} fa-thumbs-up"></i> {{ __('common.moderation-approve') }}
                                                </button>
                                            </form>
                                            <button class="btn btn-labeled btn-warning btn-xs"
                                                    @click="moderateTorrent = {'type': 'postpone',
                                                    'history': {{ ($p->history()->count() > 0 ? 'true' : 'false') }},
                                                    'id': {{$p->id}}, 'name': '{{$p->name}}' }; tab = 5;">
                                                <i class="{{ config('other.font-awesome') }} fa-pause"></i> {{ __('common.moderation-postpone') }}
                                            </button>
                                            <button class="btn btn-labeled btn-danger btn-xs"
                                                    @click="moderateTorrent = {'type': 'reject',
                                                    'history': {{ ($p->history()->count() > 0 ? 'true' : 'false') }},
                                                    'id': {{$p->id}}, 'name': '{{$p->name}}' }; tab = 5;">
                                                <i class="{{ config('other.font-awesome') }} fa-thumbs-down"></i> {{ __('common.moderation-reject') }}
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </template>
                <template x-data="{filter: {{auth()->user()->id}}}" x-if="(tab === 2 || tab === 0 )">
                    <div class="block" style="
                                        margin: 0 !important;
                                        padding-bottom: 10px !important;
                                        border-radius: 0 !important;
                                        border: none !important;
                                        box-shadow: none !important;">
                        <div style="display: flex; justify-content: space-between; flex-wrap: wrap; align-items: baseline; padding-right: 25px; margin-bottom: -6px;">
                            <div>
                                <p style="font-size: 22px; margin-top: 10px; margin-bottom: 6px;">Postponed Torrents</p>
                            </div>
                            <div><input class="form__checkbox" type="radio" :value="{{auth()->user()->id}}"
                                        x-model="filter"><label>Only Mine</label><input class="form__checkbox"
                                                                                        type="radio" :value="0"
                                                                                        x-model="filter"><label>All</label>
                            </div>
                        </div>
                        <hr style="margin-top: 10px !important; margin-bottom: 12px !important;"/>
                        <div class="table-responsive">
                            <table class="table table-condensed table-striped table-bordered"
                                   style="margin-bottom: 0 !important;">
                                <thead>
                                <tr>
                                    <th class="text-center"><i class="fas fa-user-edit"></i></th>
                                    <th>Moderated</th>
                                    <th class="torrents-filename">Torrent Name</th>
                                    <th>Category</th>
                                    <th>Type</th>
                                    <th>Resolution</th>
                                    <th>Size</th>
                                    <th>Uploader</th>
                                    <th>Moderation</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($postponed as $p)
                                    <template x-if="filter == 0 || filter == {{$p->moderated_by}}">
                                        <tr>
                                            <td class="text-center">@if( $p->updated_at->greaterThan($p->moderated_at))
                                                    <i class="fas fa-check-circle" style="color: #209e05"></i>
                                                @else
                                                    <i class="fas fa-times-circle" style="color: #9e0505"></i>
                                                @endif</td>
                                            <td style="font-size: 1.2rem">{{$p->moderated_at->diffForHumans()}}<br><span
                                                        style="font-size: 1rem">{{\App\Models\User::find($p->moderated_by)->username}}</span>
                                            </td>
                                            <td class="torrents-filename"><a target="_blank"
                                                                             href="{{route('torrent', ['id'=> $p->id])}}">{{$p->name}}
                                                    <i style="font-size: 1rem" class="fas fa-external-link"></i></a>
                                            </td>
                                            <td>{{$p->category->name}}</td>
                                            <td>{{$p->type->name}}</td>
                                            <td>{{$p->resolution->name}}</td>
                                            <td>{{$p->getSize()}}</td>
                                            <td>{{$p->user->username}}</td>
                                            <td>
                                                <button class="btn btn-labeled btn-info btn-xs"
                                                        @click="reviewTorrent = '{{ route('torrent', ['id' => $p->id]) }}?iframe=1'; tab = 4;">
                                                    <i class="fas fa-file-search"></i> Review
                                                </button>
                                                <form role="form" method="POST"
                                                      action="{{ route('staff.moderation.approve', ['id' => $p->id]) }}"
                                                      style="display: inline-block;">
                                                    @csrf
                                                    <button type="submit"
                                                            class="btn btn-labeled btn-xs btn-success">
                                                        <i class="{{ config('other.font-awesome') }} fa-thumbs-up"></i> {{ __('common.moderation-approve') }}
                                                    </button>
                                                </form>
                                                <button class="btn btn-labeled btn-danger btn-xs">
                                                    <i class="{{ config('other.font-awesome') }} fa-thumbs-down"></i> {{ __('common.moderation-reject') }}
                                                </button>
                                            </td>
                                        </tr>
                                    </template>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </template>
                <template x-if="( tab === 3 || tab === 0 )">
                    <div class="block" style="
                                        margin: 0 !important;
                                        padding-bottom: 10px !important;
                                        border-radius: 0 !important;
                                        border: none !important;
                                        box-shadow: none !important;">
                        <div><p style="font-size: 22px; margin-top: 10px; margin-bottom: 6px;">Rejected Torrents</p>
                        </div>
                        <hr style="margin-top: 10px; margin-bottom: 12px !important;"/>
                        <div class="table-responsive">
                            <table class="table table-condensed table-striped table-bordered"
                                   style="margin-bottom: 0 !important;">
                                <thead>
                                <tr>
                                    <th>Moderated</th>
                                    <th class="torrents-filename">Torrent Name</th>
                                    <th>Category</th>
                                    <th>Type</th>
                                    <th>Resolution</th>
                                    <th>Size</th>
                                    <th>Uploader</th>
                                    <th>Moderation</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($rejected as $p)
                                    <tr>
                                        <td style="font-size: 1.2rem">{{$p->moderated_at->diffForHumans()}}</td>
                                        <td class="torrents-filename"><a target="_blank"
                                                                         href="{{route('torrent', ['id'=> $p->id])}}">{{$p->name}}
                                                <i style="font-size: 1rem" class="fas fa-external-link"></i></a></td>
                                        <td>{{$p->category->name}}</td>
                                        <td>{{$p->type->name}}</td>
                                        <td>{{$p->resolution->name}}</td>
                                        <td>{{$p->getSize()}}</td>
                                        <td>{{$p->user->username}}</td>
                                        <td>
                                            <button class="btn btn-labeled btn-info btn-xs"
                                                    @click="reviewTorrent = '{{ route('torrent', ['id' => $p->id]) }}?iframe=1'; tab = 4;">
                                                <i class="fas fa-file-search"></i> Review
                                            </button>
                                            <form role="form" method="POST"
                                                  action="{{ route('staff.moderation.approve', ['id' => $p->id]) }}"
                                                  style="display: inline-block;">
                                                @csrf
                                                <button type="submit"
                                                        class="btn btn-labeled btn-xs btn-success">
                                                    <i class="{{ config('other.font-awesome') }} fa-thumbs-up"></i> {{ __('common.moderation-approve') }}
                                                </button>
                                            </form>
                                            <button class="btn btn-labeled btn-danger btn-xs">
                                                <i class="{{ config('other.font-awesome') }} fa-thumbs-down"></i> {{ __('common.moderation-reject') }}
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </template>
                <template x-if="tab === 4 && reviewTorrent">
                    <div>
                        <iframe style="width: 100%; height: 80vh; border-style: none;" :src="reviewTorrent"></iframe>
                    </div>
                </template>
                <template x-if="tab === 5 && moderateTorrent">
                    @include('torrent.partials.mod_forms')
                </template>
            </div>
        </div>
    </div>
@endsection
