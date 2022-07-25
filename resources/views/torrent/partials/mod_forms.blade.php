<div class="block" style="margin: 0 !important; padding-bottom: 10px !important; border-radius: 0 !important;
                                          border: none !important; box-shadow: none !important;">
    <template x-if="moderateTorrent.type === 'postpone'">
        <form class="form" x-data="{'autoreject': false}"
              action="{{route('staff.moderation.postpone')}}">
            @csrf
            <input type="hidden" name="torrent_id" :value="moderateTorrent.id">
            <div class="form__group">
                <p style="font-size: 22px; margin-top: 10px; margin-bottom: 6px;">
                    Postpone Torrent: <a target="_blank"
                                         :href="'https://unit3d-master.dev.mike/torrents/'+moderateTorrent.id"><span
                                x-text="moderateTorrent.name"></span> <i
                                style="font-size: 1.2rem"
                                class="fas fa-external-link"></i></a>
                </p>
            </div>
            <div class="form__group">
                                                            <textarea style="max-height: 100px;" id="staff_note" name="staff_note"
                                                                      class="form__textarea" placeholder=""></textarea>
                <label class="form__label form__label--floating"
                       for="staff_note">
                    Staff Note
                </label>
            </div>
            <div class="form__group">
                                                            <textarea  style="max-height: 100px;" id="private_msg" name="private_msg"
                                                                      class="form__textarea" placeholder=""></textarea>
                <label class="form__label form__label--floating"
                       for="private_msg">
                    Private Message to Uploader
                </label>
            </div>
            <template x-if="moderateTorrent.history">
                <div class="form__group">
                    <textarea  style="max-height: 100px;" id="public_msg" name="public_msg" class="form__textarea" placeholder=""></textarea>
                    <label class="form__label form__label--floating" for="public_msg">
                        Public Message to Users with History
                    </label>
                </div>
            </template>
            <p class="form__group">
                <input type="checkbox" class="form__checkbox" id="auto_reject"
                       name="auto_reject" :value="true" x-model="autoreject">
                <label  class="form__label" for="auto_reject">Auto-Reject & Delete if Not
                    Updated</label>
            </p>
            <template x-if="autoreject">
                <p class="form__group">
                    <select name="autoreject" id="autoreject"
                            class="form__select">
                        <option selected disabled>Select Interval</option>
                        <option value="4">4 Hours</option>
                        <option value="12">12 Hours</option>
                        <option value="18">18 Hours</option>
                        <option value="24">1 Day</option>
                        <option value="36">1 1/2 Days</option>
                        <option value="48">2 Days</option>
                        <option value="72">3 Days</option>
                        <option value="168">7 Days</option>
                    </select>
                    <label class="form__label form__label--floating"
                           for="autoreject">
                        Auto Reject In:
                    </label>
                </p>
            </template>
            <template x-if="autoreject && moderateTorrent.history">
                <div class="form__group">
                    <textarea style="max-height: 100px;" id="delete_msg" name="delete_msg" class="form__textarea" placeholder=""></textarea>
                    <label class="form__label form__label--floating" for="delete_msg">
                        Auto Reject: Message to Users with History
                    </label>
                </div>
            </template>
            <template x-if="autoreject && moderateTorrent.history">
                <p class="form__group">
                    <input type="checkbox" class="form__checkbox"
                           id="repack_sub" name="repack_sub">
                    <label class="form__label" for="repack_sub">Auto-Reject: Enroll History for
                        Repack Notification</label>
                </p>
            </template>
            <p class="form__group">
                <button type="submit" class="form__button form__button--filled"
                        value="true">
                    Submit
                </button>
            </p>
        </form>
    </template>
    <template x-if="moderateTorrent.type === 'reject'">
        <form class="form" action="{{route('staff.moderation.reject')}}">
            @csrf
            <input type="hidden" name="torrent_id" :value="moderateTorrent.id">
            <div class="form__group">
                <p style="font-size: 22px; margin-top: 10px; margin-bottom: 6px;">
                    Reject Torrent: <a target="_blank"
                                       :href="'https://unit3d-master.dev.mike/torrents/'+moderateTorrent.id"><span
                                x-text="moderateTorrent.name"></span> <i
                                style="font-size: 1.2rem"
                                class="fas fa-external-link"></i></a>
                </p>
            </div>
            <div class="form__group">
                                                            <textarea id="staff_note" name="staff_note"
                                                                      class="form__textarea" placeholder=""></textarea>
                <label class="form__label form__label--floating"
                       for="staff_note">
                    Staff Note
                </label>
            </div>
            <div class="form__group">
                                                            <textarea id="private_msg" name="private_msg"
                                                                      class="form__textarea" placeholder=""></textarea>
                <label class="form__label form__label--floating"
                       for="private_msg">
                    Private Message to Uploader
                </label>
            </div>
            <template x-if="moderateTorrent.history">
                <div class="form__group">
                    <textarea id="public_msg" name="public_msg" class="form__textarea" placeholder=""></textarea>
                    <label class="form__label form__label--floating"
                           for="public_msg">
                        Delete Message to Users with History
                    </label>
                </div>
            </template>
            <template x-if="moderateTorrent.history">
                <div class="form__group">
                    <input type="checkbox" class="form__checkbox"
                           id="repack_sub" name="repack_sub">
                    <label class="form__label" for="repack_sub">
                        Enroll History for Repack Notification
                    </label>
                </div>
            </template>
            <p class="form__group">
                <button type="submit" class="form__button form__button--filled"
                        value="true">
                    Submit
                </button>
            </p>
        </form>
    </template>
</div>