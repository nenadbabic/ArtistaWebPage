package com.example.dolinar.artista;

import android.app.Activity;
import android.content.Context;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v7.widget.GridLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.util.Log;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.Cache;
import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.VolleyLog;
import com.android.volley.toolbox.JsonObjectRequest;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.InputStream;
import java.io.UnsupportedEncodingException;
import java.util.ArrayList;

public class ProfileActivity extends Activity {
    private String URL = "http://localhost:3000/Users";
    private static final String TAG = ProfileActivity.class.getSimpleName();
    private String profilePictureURL;
    private Context c = this;
    private final String imageTitles[] = {
            "Test",
            "Test",
            "Test",
            "Test",
            "Test",
            "Test",
            "Test",
            "Test",
            "Test",
            "Test",
            "Test",
            "Test",
            "Test",
    };

    private final Integer imageIds[] = {
            R.drawable.ic_menu_camera,
            R.drawable.ic_menu_camera,
            R.drawable.ic_menu_manage,
            R.drawable.ic_menu_send,
            R.drawable.ic_menu_slideshow,
            R.drawable.ic_menu_send,
            R.drawable.ic_menu_send,
            R.drawable.ic_menu_send,
            R.drawable.ic_menu_send,
            R.drawable.ic_menu_send,
            R.drawable.ic_menu_send,
            R.drawable.ic_menu_send,
            R.drawable.ic_menu_send,
    };

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.profile_view);

        String profileId = getIntent().getExtras().getString("id");

        URL += "/" + profileId;

        makeProfileDataRequest();

        RecyclerView recyclerView = (RecyclerView)findViewById(R.id.imagegallery);
        recyclerView.setHasFixedSize(true);

        RecyclerView.LayoutManager layoutManager = new GridLayoutManager(getApplicationContext(),2);
        recyclerView.setLayoutManager(layoutManager);
        ArrayList<CreateList> createLists = prepareData();
        ImageAdapter adapter = new ImageAdapter(getApplicationContext(), createLists);
        recyclerView.setAdapter(adapter);



    }

    private void makeProfileDataRequest() {
        Cache cache = AppController.getInstance().getRequestQueue().getCache();
        Cache.Entry entry = cache.get(URL);
        if (entry != null) {
            // fetch the data from cache
            try {
                String data = new String(entry.data, "UTF-8");
                try {
                    parseData(new JSONObject(data));
                } catch (JSONException e) {
                    e.printStackTrace();
                }
            } catch (UnsupportedEncodingException e) {
                e.printStackTrace();
            }

        } else {

            // making fresh volley request and getting json
            JsonObjectRequest jsonReq = new JsonObjectRequest(Request.Method.GET,
                    URL, null, new Response.Listener<JSONObject>() {

                @Override
                public void onResponse(JSONObject response) {
                    VolleyLog.d(TAG, "Response: " + response.toString());
                    parseData(response);
                }
            }, new Response.ErrorListener() {

                @Override
                public void onErrorResponse(VolleyError error) {
                    VolleyLog.d(TAG, "Error: " + error.getMessage());
                }
            });

            // Adding request to volley request queue
            AppController.getInstance().addToRequestQueue(jsonReq);
        }
    }

    private void parseData(JSONObject jsonObject) {

        try {
            JSONArray feedArray = jsonObject.getJSONArray("user");
            Toast.makeText(this, feedArray.toString() + "123", Toast.LENGTH_LONG).show();
            for (int i = 0; i < feedArray.length(); i++) {
                JSONObject feedObj = (JSONObject) feedArray.get(i);

                profilePictureURL = "https://cdn.pixabay.com/photo/2017/10/18/10/15/stick-man-2863519_960_720.png";

                ImageView bindImage = (ImageView)findViewById(R.id.profilePic);
                DownloadImageWithURLTask downloadTask = new DownloadImageWithURLTask(bindImage);
                downloadTask.execute(profilePictureURL);

                TextView nameView = (TextView) findViewById(R.id.name);
                nameView.setText(feedObj.getString("name"));

                TextView ratingView = (TextView) findViewById(R.id.rating);
                ratingView.setText("Ocena: " + feedObj.getString("type"));

                TextView emailView = (TextView) findViewById(R.id.email);
                emailView.setText("Kontakt: " + feedObj.getString("email"));


            }

        } catch (JSONException e) {
            e.printStackTrace();
        }
    }

    private class DownloadImageWithURLTask extends AsyncTask<String, Void, Bitmap> {
        ImageView bmImage;

        public DownloadImageWithURLTask(ImageView bmImage) {
            this.bmImage = bmImage;
        }

        @Override
        protected Bitmap doInBackground(String... params) {
            Bitmap bitmap = null;
            try {
                InputStream in = new java.net.URL(profilePictureURL).openStream();
                bitmap = BitmapFactory.decodeStream(in);
            } catch (Exception e) {
                Log.e("Error", e.getMessage());
                e.printStackTrace();
            }
            return bitmap;
        }
        protected void onPostExecute(Bitmap result) {
            bmImage.setImageBitmap(result);
        }
    }
    private ArrayList<CreateList> prepareData(){

        ArrayList<CreateList> theimage = new ArrayList<>();
        for(int i = 0; i< imageTitles.length; i++){
            CreateList createList = new CreateList();
            createList.setImage_title(imageTitles[i]);
            createList.setImage_ID(imageIds[i]);
            theimage.add(createList);
        }
        return theimage;
    }
}
