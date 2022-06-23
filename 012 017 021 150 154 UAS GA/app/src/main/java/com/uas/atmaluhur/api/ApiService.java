package com.uas.atmaluhur.api;

import com.uas.atmaluhur.model.LaporModel;
import com.uas.atmaluhur.model.ListLocationModel;

import okhttp3.MultipartBody;
import retrofit2.Call;
import retrofit2.http.GET;
import retrofit2.http.Multipart;
import retrofit2.http.POST;
import retrofit2.http.Part;

public interface ApiService {
    @GET("JsonDisplayMarker.php")
    Call<ListLocationModel> getAllLocation();

    @Multipart
    @POST("upload_api.php")
    Call<LaporModel> uploadLaporModel(@Part MultipartBody.Part image,
                                      @Part("nama") String nama,
                                      @Part("latitude") Double latitude,
                                      @Part("longitude") Double longitude);
}
