import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.IOException;
import java.io.InputStream;
import java.io.OutputStream;
import java.net.URL;
import java.net.URLConnection;

public class Task {
	String CRNum = null;
	String TaskNum = null;
	String TaskSummary = null;
	String ImplanTeam = null;
	String TaskStartTime = null;
	String AttachName = null;
	String AttachString = null;
	String ViewState = null;
	String cookie = null;
	String URL2 = "http://xxxx/GSDChgPlan/jsp/view_implementation_plan.faces";

	public String getShortName() {
		return "Task" + TaskNum + "_" + TaskStartTime;
	}

	public void AttachDownload() throws FileNotFoundException, InterruptedException {
		int retryTime = 0;
		String FileURL = "viewTaskForm=viewTaskForm&chg_id=" + CRNum
				+ "&time_zone=Asia%2FShanghai&javax.faces.ViewState=" + ViewState + "&" + AttachString + "="
				+ AttachString;
		InputStream ins = HttpClient.getInput(URL2, FileURL, cookie);
		String fileName = "C:\\Users\\xxxx\\Desktop\\RunTime\\" + CRNum + "\\" + this.getShortName() + ".zip";
		DataUtil.downloadHandler(ins,fileName);
		//System.out.println(FileURL);
		while (!DataUtil.checkFile(fileName) && retryTime<5){
			//System.out.println("Retry!"+retryTime+"times");
			retryTime+=1;
			DataUtil.downloadHandler(ins,fileName);
		}
	}

}
