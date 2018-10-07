<el-row>
    <el-col :span="24">
        <label>请选择视频文件</label><br>
        <input type="file" name="file" id="video_files"/>
        <p>上传进度：<span id="upload-progress">暂无</span></p>
        <input type="hidden" name="video_id" id="video_id" value="{{$videoId ?? ''}}">
    </el-col>
    <el-col :span="24">
        <el-button type="success" id="start-upload">开始上传</el-button>
        <el-button type="danger" id="stop-upload">停止上传</el-button>
    </el-col>
</el-row>