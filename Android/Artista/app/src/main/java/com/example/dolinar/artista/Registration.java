package com.example.dolinar.artista;


import android.content.Intent;
import android.os.Bundle;
import android.support.annotation.Nullable;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import org.apache.http.HttpResponse;
import org.apache.http.NameValuePair;
import org.apache.http.client.ClientProtocolException;
import org.apache.http.client.HttpClient;
import org.apache.http.client.entity.UrlEncodedFormEntity;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.message.BasicNameValuePair;

import java.io.BufferedOutputStream;
import java.io.IOException;
import java.io.OutputStream;
import java.io.UnsupportedEncodingException;
import java.net.HttpURLConnection;
import java.net.URL;
import java.util.ArrayList;
import java.util.List;

public class Registration extends AppCompatActivity{

    String name;
    String email;
    String password;
    @Override
    protected void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.registration_view);

        final TextView nameView = (TextView) findViewById(R.id.input_name_reg);
        final TextView emailView = (TextView) findViewById(R.id.input_email_reg);
        final TextView passwordView = (TextView) findViewById(R.id.input_password_reg);
        final TextView usernameView = (TextView) findViewById(R.id.username_input_reg);

        TextView tv = (TextView) findViewById(R.id.link_login);
        tv.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent i = new Intent(getApplicationContext(), Login.class);
                startActivity(i);
                finish();
            }
        });

        Button loginBtn = (Button) findViewById(R.id.btn_signup);
        loginBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                name = nameView.getText().toString();
                email = emailView.getText().toString();
                password = passwordView.getText().toString();
                String username = usernameView.getText().toString();
                if (name.equals("") || email.equals("") || password.equals("") || username.equals("")) {
                    Toast.makeText(getApplicationContext(), "Vnesite vsa polja!", Toast.LENGTH_LONG).show();
                } else {
                    Toast.makeText(getApplicationContext(), "OK", Toast.LENGTH_LONG).show();
                    //createPostRequest();

                }
            }
        });
    }
    private void createPostRequest() {
// Create a new HttpClient and Post Header
        HttpClient httpclient = new DefaultHttpClient();
        HttpPost httppost = new HttpPost("http://localhost:3000/Users/");

        try {
            // Add your data
            List<NameValuePair> nameValuePairs = new ArrayList<NameValuePair>(3);
            nameValuePairs.add(new BasicNameValuePair("name", name));
            nameValuePairs.add(new BasicNameValuePair("email", email));
            nameValuePairs.add(new BasicNameValuePair("pwdhash", password));
            httppost.setEntity(new UrlEncodedFormEntity(nameValuePairs));

            // Execute HTTP Post Request
            HttpResponse response = httpclient.execute(httppost);

        } catch (IOException e) {
            Toast.makeText(getApplicationContext(), e.getMessage(), Toast.LENGTH_LONG).show();
        }
    }
}
