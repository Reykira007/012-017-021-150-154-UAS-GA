package com.uas.atmaluhur.model;

import com.google.gson.annotations.SerializedName;

public class LocationModel {
    @SerializedName("nama")
    private String imageLocationName;
    @SerializedName("latitude")
    private String latitude;
    @SerializedName("longitude")
    private String longitude;
    @SerializedName("tgl_kejadian")
    private String tglKejadian;
    @SerializedName("verifikasi")
    private String verifikasi;

    public LocationModel(String imageLocationName, String latitude, String longitude, String tglKejadian, String verifikasi) {
        this.imageLocationName = imageLocationName;
        this.latitude = latitude;
        this.longitude = longitude;
        this.tglKejadian = tglKejadian;
        this.verifikasi = verifikasi;
    }

    public LocationModel() {
    }

    public String getImageLocationName() { return imageLocationName; }

    public void setImageLocationName(String imageLocationName) {
        this.imageLocationName = imageLocationName;
    }

    public String getLatitude() { return latitude; }

    public void setLatitude(String latitude) { this.latitude = latitude; }

    public  String getLongitude() { return longitude; }

    public void setLongitude(String longitude) { this.longitude = longitude; }

    public String getTglKejadian() { return tglKejadian; }

    public void setTglKejadian(String tglKejadian) { this.tglKejadian = tglKejadian; }

    public String getVerifikasi() {
        return verifikasi;
    }

    public void setVerifikasi(String verifikasi) {
        this.verifikasi = verifikasi;
    }
}
