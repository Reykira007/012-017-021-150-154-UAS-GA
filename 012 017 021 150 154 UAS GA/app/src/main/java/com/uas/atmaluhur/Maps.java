package com.uas.atmaluhur;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import androidx.fragment.app.FragmentActivity;

import android.Manifest;
import android.app.AlertDialog;
import android.app.ProgressDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.location.LocationManager;
import android.os.Bundle;
import android.provider.Settings;
import android.view.View;
import android.widget.Button;
import android.widget.Toast;

import com.google.android.gms.maps.CameraUpdateFactory;
import com.google.android.gms.maps.GoogleMap;
import com.google.android.gms.maps.OnMapReadyCallback;
import com.google.android.gms.maps.SupportMapFragment;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.MarkerOptions;
import com.uas.atmaluhur.api.ApiClient;
import com.uas.atmaluhur.api.ApiService;
import com.uas.atmaluhur.databinding.ActivityMapsBinding;
import com.uas.atmaluhur.model.ListLocationModel;
import com.uas.atmaluhur.model.LocationModel;

import java.util.ArrayList;
import java.util.List;

import pub.devrel.easypermissions.EasyPermissions;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class Maps extends AppCompatActivity implements OnMapReadyCallback,
        EasyPermissions.PermissionCallbacks {

    private GoogleMap mMap;
    private  List<LocationModel> mListMarker = new ArrayList<>();
    private Button refresh, lapor, kembali;

    private final int REQUEST_LOCATION_PERMISSION = 1;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_maps);
        refresh = findViewById(R.id.btn_refresh);
        lapor = findViewById(R.id.btn_lapor);
        kembali = findViewById(R.id.btn_kembali);

        //Obtain the SupportMapFragment and get notified when the map is ready to be used.
        SupportMapFragment mapFragment = (SupportMapFragment) getSupportFragmentManager()
                .findFragmentById(R.id.map);
        mapFragment.getMapAsync(this);

        refresh.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                finish();
                startActivity(getIntent());
            }
        });

        lapor.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

                LocationManager locationManager = (LocationManager) getSystemService(LOCATION_SERVICE);

                if (locationManager.isProviderEnabled(LocationManager.GPS_PROVIDER)){
                    //enable
                    Toast.makeText(Maps.this, "Lokasi aktif!", Toast.LENGTH_SHORT).show();
                    locationPermission();
                }else{
                    showGpsDisabledAlert();
                }
            }
        });
    }

    private void locationPermission() {
        if (EasyPermissions.hasPermissions(this, Manifest.permission.ACCESS_FINE_LOCATION)){
            //jika di acc
            startActivity(new Intent(Maps.this, Lapor.class));
        }else {
            //jika di tolak
            EasyPermissions.requestPermissions(this, "Perlu akses lokasi untuk melaporkan!",
                    REQUEST_LOCATION_PERMISSION,Manifest.permission.ACCESS_FINE_LOCATION);
        }
    }

    //cek gps
    private void showGpsDisabledAlert() {
        AlertDialog.Builder alertDialog = new AlertDialog.Builder(this);
        alertDialog.setCancelable(false)
                .setMessage("Location GPS tidak aktif, Silahkan aktifkan!")
                .setPositiveButton("Pengaturan", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialogInterface, int i) {
                        Intent callGpsSetting =new Intent(Settings.ACTION_LOCATION_SOURCE_SETTINGS);
                        startActivity(callGpsSetting);
                    }
                });
        alertDialog.setNegativeButton("Batal", new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialogInterface, int i) {
                dialogInterface.cancel();
            }
        });
        alertDialog.create().show();
    }

    @Override
    public void onPermissionsGranted(int requestCode, @NonNull List<String> perms) {

    }

    @Override
    public void onPermissionsDenied(int requestCode, @NonNull List<String> perms) {
        Toast.makeText(this, "Izin ditolak : " + requestCode, Toast.LENGTH_SHORT).show();
        //jika tidak di allow, minta permission lagi
        EasyPermissions.requestPermissions(this, "Melapor perlu akses lokasi!",
                REQUEST_LOCATION_PERMISSION,Manifest.permission.ACCESS_FINE_LOCATION);
    }

    @Override
    public void onMapReady(@NonNull GoogleMap googleMap) {
        mMap = googleMap;

        //membuat zoom in dan zoom out
        mMap.getUiSettings().setMyLocationButtonEnabled(true);
        mMap.getUiSettings().setZoomControlsEnabled(true);
        mMap.getUiSettings().setCompassEnabled(true);
        mMap.getUiSettings().setMapToolbarEnabled(true);
        //diarahkan ke class getalldatalocationlatlng
        getAllDataLocationLatLng();
    }

    private void getAllDataLocationLatLng() {
        final ProgressDialog dialog = new ProgressDialog(this);
        dialog.setMessage("Menampilkan data marker ...");
        dialog.show();

        ApiService apiService = ApiClient.getClient().create(ApiService.class);
        Call<ListLocationModel> call = apiService.getAllLocation();
        call.enqueue(new Callback<ListLocationModel>() {
            @Override
            public void onResponse(Call<ListLocationModel> call, Response<ListLocationModel> response) {
                dialog.dismiss();
                mListMarker = response.body().getmData();
                initMarker(mListMarker);
            }

            @Override
            public void onFailure(Call<ListLocationModel> call, Throwable t) {
                dialog.dismiss();
                Toast.makeText(Maps.this, t.getMessage(), Toast.LENGTH_SHORT).show();
            }
        });
    }

    private void initMarker(List<LocationModel> mListMarker) {
        //iterasi semua data dan tampilkan markernya
        for (int i=0; i<mListMarker.size(); i++){
            //set latlng nya
            LatLng location = new LatLng(Double.parseDouble(mListMarker.get(i).getLatitude()), Double.parseDouble(mListMarker.get(i).getLongitude()));
            //tambahkan markernya
            mMap.addMarker(new MarkerOptions().position(location).title(mListMarker.get(i).getImageLocationName()));
            //tambahkan tgl
            mMap.addMarker(new MarkerOptions().position(location).title(mListMarker.get(i).getTglKejadian()));
            //set latlng index ke 0
            LatLng latLng = new LatLng(Double.parseDouble(mListMarker.get(0).getLatitude()), Double.parseDouble(mListMarker.get(0).getLongitude()));
            //lalu arahkan zooming ke marker index ke 0
            mMap.animateCamera(CameraUpdateFactory.newLatLngZoom(new LatLng(latLng.latitude,latLng.longitude), 11.0f));
        }
    }
    public void back(View view){
        Intent b = new Intent(Maps.this, MainActivity.class);
        startActivity(b);
    }
}