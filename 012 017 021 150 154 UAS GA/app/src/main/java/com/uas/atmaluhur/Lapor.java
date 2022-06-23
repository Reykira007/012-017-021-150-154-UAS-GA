package com.uas.atmaluhur;

import static com.google.android.gms.location.Priority.PRIORITY_HIGH_ACCURACY;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.app.ActivityCompat;
import androidx.core.content.ContextCompat;

import android.Manifest;
import android.annotation.SuppressLint;
import android.app.DatePickerDialog;
import android.app.ProgressDialog;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.graphics.Color;
import android.graphics.drawable.ColorDrawable;
import android.location.Location;
import android.net.Uri;
import android.os.AsyncTask;
import android.os.Bundle;
import android.provider.MediaStore;
import android.util.Base64;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.DatePicker;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.google.android.gms.location.FusedLocationProviderClient;
import com.google.android.gms.location.LocationServices;
import com.google.android.gms.tasks.CancellationToken;
import com.google.android.gms.tasks.OnSuccessListener;
import com.google.android.gms.tasks.OnTokenCanceledListener;
import com.uas.atmaluhur.api.ApiService;
import com.uas.atmaluhur.api.RetrofitBuilder;
import com.uas.atmaluhur.model.LaporModel;

import java.io.ByteArrayOutputStream;
import java.io.File;
import java.io.IOException;
import java.util.Calendar;
import java.util.HashMap;

import okhttp3.MediaType;
import okhttp3.MultipartBody;
import okhttp3.RequestBody;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class Lapor extends AppCompatActivity {
    private EditText txtLatitude;
    private EditText txtLongitude;
    private EditText txtNama;
    private Button button_lapor;

    FusedLocationProviderClient mFusedLocationClient;

    @SuppressLint("missingpermission")
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        getSupportActionBar().hide();
        setContentView(R.layout.activity_lapor);

        txtLatitude = (EditText) findViewById(R.id.etLatitude);
        txtLongitude = (EditText) findViewById(R.id.etLongitude);
        txtNama = (EditText) findViewById(R.id.etNama);
        button_lapor = (Button) findViewById(R.id.button_lapor);


        // Dapatkan titik Latlng
        mFusedLocationClient = LocationServices.getFusedLocationProviderClient(this);
        mFusedLocationClient.getCurrentLocation(PRIORITY_HIGH_ACCURACY, new CancellationToken() {
            @NonNull
            @Override
            public CancellationToken onCanceledRequested(@NonNull OnTokenCanceledListener onTokenCanceledListener) {
                return null;
            }

            @Override
            public boolean isCancellationRequested() {
                return false;
            }
        }).addOnSuccessListener(new OnSuccessListener<Location>() {
            @Override
            public void onSuccess(Location location) {
                txtLatitude.setText(String.valueOf(location.getLatitude()));
                txtLatitude.setEnabled(false);
                txtLongitude.setText(String.valueOf(location.getLongitude()));
                txtLongitude.setEnabled(false);
            }
        });
    }

    //kirim ke database
    public void tambah_Lapor (View view) {
        final String Nama = txtNama.getText().toString().trim();
        final String Latitude = txtLatitude.getText().toString().trim();
        final String Longitude = txtLongitude.getText().toString().trim();

        class tambah_Lapor extends AsyncTask<Void, Void, String> {
            ProgressDialog loading;
            @Override
            protected void onPreExecute() {
                super.onPreExecute();
                loading = ProgressDialog.show(Lapor.this, "Add...", "Wait...",
                        false, false);
            }

            @Override
            protected String doInBackground (Void... v) {
                HashMap<String, String> params = new HashMap<>();
                //   params.put("id", id);
                params.put("nama", Nama);
                params.put("latitude", Latitude);
                params.put("longitude", Longitude);

                RequestHandler rh = new RequestHandler();
                String res = rh.sendPostRequest("http://192.168.1.7/damkar/lapor.php", params);
                return res;
            }

            @Override
            protected void onPostExecute(String s) {
                super.onPostExecute(s);
                loading.dismiss();

                if(s.equals("berhasil")) {
                    Toast.makeText(Lapor.this,
                            "Tambah Laporan Berhasil, Tunggu verifikasi dari Admin Server!", Toast.LENGTH_LONG).show();
                    Intent i = new Intent(Lapor.this, MainActivity.class);
                    startActivity(i);
                } else {
                    System.out.println(s);
                    Toast.makeText(Lapor.this,
                            "Data Harus Lengkap", Toast.LENGTH_SHORT).show();
                }
            }
        }

        tambah_Lapor a = new tambah_Lapor();
        a.execute();
    }

    public void back(View view){
        Intent i = new Intent(Lapor.this, MainActivity.class);
        startActivity(i);
    }
}